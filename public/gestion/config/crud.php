<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Moteur CRUD de l'administration
|--------------------------------------------------------------------------
|
| Utilisé par le fichier ajax_handler.php de chaque module :
|
|     require_once __DIR__ . '/../../../config/crud.php';
|     crud_handle('actualites');
|
| Le module est décrit dans config/tables.php. Ce fichier gère :
|   - la liste, la lecture, l'ajout, la modification et la suppression ;
|   - l'envoi des images dans public/images/<dossier>/ (nom de fichier
|     seul en base, comme le fait Laravel) ;
|   - les dates created_at / updated_at (en UTC, comme Laravel) ;
|   - le hachage bcrypt des mots de passe (compatible avec Laravel) ;
|   - la protection CSRF sur les écritures.
|
*/

/**
 * Erreur dont le message peut être montré à l'utilisateur.
 */
final class CrudUserError extends RuntimeException
{
}

/**
 * Envoie une réponse JSON et arrête le script.
 */
function crud_respond(array $payload, int $status = 200): never
{
    http_response_code($status);

    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);

    exit;
}

/**
 * Liste des colonnes lisibles d'un module (le mot de passe n'est jamais renvoyé).
 */
function crud_select_columns(array $cfg): string
{
    $columns = ['`id`'];

    foreach ($cfg['fields'] as $name => $field) {

        if ($field['type'] === 'password') {
            continue;
        }

        $columns[] = '`' . $name . '`';
    }

    $columns[] = '`created_at`';

    return implode(', ', $columns);
}

/**
 * Enregistre une image envoyée et retourne le nom du fichier créé.
 */
function crud_store_image(array $file, string $dir, array $app): string
{
    $error = (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE);

    if ($error === UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE) {
        throw new CrudUserError('Image trop volumineuse (5 Mo maximum).');
    }

    if ($error !== UPLOAD_ERR_OK) {
        throw new CrudUserError("L'envoi de l'image a échoué. Réessayez.");
    }

    $tmp = (string) ($file['tmp_name'] ?? '');

    if ($tmp === '' || !is_uploaded_file($tmp)) {
        throw new CrudUserError('Fichier invalide.');
    }

    if ((int) ($file['size'] ?? 0) > (int) $app['max_upload_size']) {
        throw new CrudUserError('Image trop volumineuse (5 Mo maximum).');
    }

    // Le type est lu dans le contenu du fichier, pas dans son nom.
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($tmp);

    $extensions = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif',
        'image/webp' => 'webp',
    ];

    if (!isset($extensions[$mime]) || @getimagesize($tmp) === false) {
        throw new CrudUserError('Format non autorisé. Utilisez JPG, PNG, GIF ou WEBP.');
    }

    $folder = rtrim((string) $app['images_path'], '/\\') . '/' . $dir;

    if (!is_dir($folder) && !mkdir($folder, 0755, true) && !is_dir($folder)) {
        throw new CrudUserError("Impossible de créer le dossier d'images.");
    }

    if (!is_writable($folder)) {
        throw new CrudUserError("Le dossier d'images n'est pas accessible en écriture.");
    }

    // Même principe de nommage que Laravel : time() + nombre aléatoire.
    $filename = time() . mt_rand(100000, 999999999) . '.' . $extensions[$mime];

    if (!move_uploaded_file($tmp, $folder . '/' . $filename)) {
        throw new CrudUserError("Impossible d'enregistrer l'image.");
    }

    @chmod($folder . '/' . $filename, 0644);

    return $filename;
}

/**
 * Supprime un fichier image devenu inutile.
 *
 * Sécurités :
 *  - seuls les fichiers au nom généré (time + aléatoire) sont supprimés,
 *    ce qui protège les images fixes du site (ex. 1.jpg, 2.jpg) ;
 *  - un fichier encore utilisé par une autre ligne n'est pas supprimé.
 */
function crud_delete_image(
    ?string $filename,
    string $dir,
    string $column,
    string $table,
    PDO $pdo,
    array $app
): void {

    if ($filename === null || $filename === '') {
        return;
    }

    if (!preg_match('/^\d{10,}\.[A-Za-z0-9]{2,5}$/', $filename)) {
        return;
    }

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `{$table}` WHERE `{$column}` = ?");
    $stmt->execute([$filename]);

    if ((int) $stmt->fetchColumn() > 0) {
        return;
    }

    $path = rtrim((string) $app['images_path'], '/\\') . '/' . $dir . '/' . $filename;

    if (is_file($path)) {
        @unlink($path);
    }
}

/**
 * Point d'entrée : traite la requête AJAX d'un module.
 */
function crud_handle(string $module): void
{
    header('Content-Type: application/json; charset=utf-8');
    header('X-Content-Type-Options: nosniff');

    // Pour auth.php : répondre en JSON (401) plutôt que rediriger.
    if (!defined('GESTION_JSON')) {
        define('GESTION_JSON', true);
    }

    // Session, expiration, jeton CSRF ($app, $currentUser).
    require_once __DIR__ . '/auth.php';

    // Connexion PDO ($pdo).
    require __DIR__ . '/database.php';

    $tables = require __DIR__ . '/tables.php';

    if (!isset($tables[$module])) {
        crud_respond(['status' => 'error', 'message' => 'Module inconnu.'], 404);
    }

    $cfg      = $tables[$module];
    $readonly = !empty($cfg['readonly']);

    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
        crud_respond(['status' => 'error', 'message' => 'Méthode non autorisée.'], 405);
    }

    // Requête trop grosse pour PHP (post_max_size) : $_POST arrive vide.
    if (
        empty($_POST)
        && empty($_FILES)
        && (int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > 0
    ) {
        crud_respond([
            'status'  => 'error',
            'message' => 'Fichier trop volumineux pour le serveur.',
        ]);
    }

    $action = (string) ($_POST['action'] ?? '');

    // Les écritures exigent un jeton CSRF valide.
    if (in_array($action, ['save_item', 'delete_item'], true)) {

        $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['_csrf'] ?? '');

        if (
            !is_string($token)
            || empty($_SESSION['_csrf'])
            || !hash_equals($_SESSION['_csrf'], $token)
        ) {
            crud_respond([
                'status'  => 'error',
                'message' => 'Session invalide. Rechargez la page.',
            ], 403);
        }
    }

    $response = ['status' => 'error', 'message' => 'Action inconnue.'];

    $newImages = []; // fichiers créés pendant cette requête (à nettoyer en cas d'échec)

    try {

        switch ($action) {

            // -------------------------------------------------------------
            // LISTE
            // -------------------------------------------------------------
            case 'fetch_items':

                $columns = crud_select_columns($cfg);

                $rows = $pdo
                    ->query("SELECT {$columns} FROM `{$module}` ORDER BY `id` DESC")
                    ->fetchAll();

                $response = ['status' => 'success', 'data' => $rows];

                break;

            // -------------------------------------------------------------
            // UN ÉLÉMENT
            // -------------------------------------------------------------
            case 'fetch_single_item':

                $id = (int) ($_POST['id'] ?? 0);

                if ($id <= 0) {
                    throw new CrudUserError('Identifiant manquant.');
                }

                $columns = crud_select_columns($cfg);

                $stmt = $pdo->prepare("SELECT {$columns} FROM `{$module}` WHERE `id` = ?");
                $stmt->execute([$id]);

                $item = $stmt->fetch();

                if (!$item) {
                    throw new CrudUserError('Élément introuvable.');
                }

                $response = ['status' => 'success', 'data' => $item];

                break;

            // -------------------------------------------------------------
            // AJOUTER OU MODIFIER
            // -------------------------------------------------------------
            case 'save_item':

                if ($readonly) {
                    throw new CrudUserError('Ce module est en lecture seule.');
                }

                $id       = (int) ($_POST['id'] ?? 0);
                $existing = null;

                if ($id > 0) {

                    $stmt = $pdo->prepare("SELECT * FROM `{$module}` WHERE `id` = ?");
                    $stmt->execute([$id]);

                    $existing = $stmt->fetch();

                    if (!$existing) {
                        throw new CrudUserError('Élément introuvable.');
                    }
                }

                $data      = [];
                $oldImages = []; // [colonne => ancien fichier] à supprimer après succès

                foreach ($cfg['fields'] as $name => $field) {

                    $type     = $field['type'];
                    $label    = $field['label'];
                    $required = !empty($field['required']);

                    // ---------- IMAGE ----------
                    if ($type === 'image') {

                        $file = $_FILES[$name] ?? null;

                        $hasUpload = is_array($file)
                            && (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;

                        if ($hasUpload) {

                            $stored = crud_store_image($file, (string) $cfg['image_dir'], $app);

                            $newImages[$name] = $stored;
                            $data[$name]      = $stored;

                            if ($existing !== null) {
                                $oldImages[$name] = (string) $existing[$name];
                            }

                        } elseif ($existing === null && $required) {

                            throw new CrudUserError("Le champ « {$label} » est obligatoire.");
                        }

                        continue;
                    }

                    $value = $_POST[$name] ?? '';

                    if (!is_string($value)) {
                        throw new CrudUserError("Valeur invalide pour « {$label} ».");
                    }

                    // ---------- MOT DE PASSE ----------
                    if ($type === 'password') {

                        if ($value === '') {

                            if ($existing === null && $required) {
                                throw new CrudUserError("Le champ « {$label} » est obligatoire.");
                            }

                            // Modification sans nouveau mot de passe : on garde l'ancien.
                            continue;
                        }

                        if (mb_strlen($value) < 8) {
                            throw new CrudUserError('Le mot de passe doit contenir au moins 8 caractères.');
                        }

                        // bcrypt ignore tout ce qui dépasse 72 octets.
                        if (strlen($value) > 72) {
                            throw new CrudUserError('Le mot de passe est trop long (72 caractères maximum).');
                        }

                        $data[$name] = password_hash($value, PASSWORD_BCRYPT);

                        continue;
                    }

                    // ---------- TEXTE / EMAIL / TEXTAREA ----------
                    $value = trim($value);

                    if ($required && $value === '') {
                        throw new CrudUserError("Le champ « {$label} » est obligatoire.");
                    }

                    if (isset($field['max']) && mb_strlen($value) > (int) $field['max']) {
                        throw new CrudUserError(
                            "Le champ « {$label} » ne doit pas dépasser {$field['max']} caractères."
                        );
                    }

                    if ($type === 'email' && $value !== '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        throw new CrudUserError("L'adresse e-mail de « {$label} » n'est pas valide.");
                    }

                    $data[$name] = $value;
                }

                // E-mail unique pour les administrateurs (contrainte de la table).
                if ($module === 'admins' && isset($data['email'])) {

                    $stmt = $pdo->prepare('SELECT `id` FROM `admins` WHERE `email` = ? AND `id` <> ?');
                    $stmt->execute([$data['email'], $id]);

                    if ($stmt->fetch()) {
                        throw new CrudUserError('Cette adresse e-mail est déjà utilisée.');
                    }
                }

                $now = gmdate('Y-m-d H:i:s');

                // ---------- MODIFICATION ----------
                if ($id > 0) {

                    if (empty($data)) {
                        $response = ['status' => 'success', 'message' => 'Aucune modification.'];
                        break;
                    }

                    $data['updated_at'] = $now;

                    $sets = [];

                    foreach (array_keys($data) as $column) {
                        $sets[] = "`{$column}` = ?";
                    }

                    $values   = array_values($data);
                    $values[] = $id;

                    $stmt = $pdo->prepare(
                        "UPDATE `{$module}` SET " . implode(', ', $sets) . ' WHERE `id` = ?'
                    );
                    $stmt->execute($values);

                    // Les anciennes images ne sont supprimées qu'après la réussite.
                    foreach ($oldImages as $column => $oldFile) {
                        crud_delete_image($oldFile, (string) $cfg['image_dir'], $column, $module, $pdo, $app);
                    }

                    $response = ['status' => 'success', 'message' => 'Élément modifié avec succès.'];

                    break;
                }

                // ---------- AJOUT ----------
                $data['created_at'] = $now;
                $data['updated_at'] = $now;

                $columnsSql = '`' . implode('`, `', array_keys($data)) . '`';
                $marks      = implode(', ', array_fill(0, count($data), '?'));

                $stmt = $pdo->prepare("INSERT INTO `{$module}` ({$columnsSql}) VALUES ({$marks})");
                $stmt->execute(array_values($data));

                $response = ['status' => 'success', 'message' => 'Élément ajouté avec succès.'];

                break;

            // -------------------------------------------------------------
            // SUPPRIMER
            // -------------------------------------------------------------
            case 'delete_item':

                $id = (int) ($_POST['id'] ?? 0);

                if ($id <= 0) {
                    throw new CrudUserError('Identifiant manquant.');
                }

                $stmt = $pdo->prepare("SELECT * FROM `{$module}` WHERE `id` = ?");
                $stmt->execute([$id]);

                $item = $stmt->fetch();

                if (!$item) {
                    throw new CrudUserError('Élément introuvable.');
                }

                if ($module === 'admins') {

                    if ($id === (int) $currentUser['id']) {
                        throw new CrudUserError('Vous ne pouvez pas supprimer votre propre compte.');
                    }

                    $count = (int) $pdo->query('SELECT COUNT(*) FROM `admins`')->fetchColumn();

                    if ($count <= 1) {
                        throw new CrudUserError('Impossible de supprimer le dernier administrateur.');
                    }
                }

                $stmt = $pdo->prepare("DELETE FROM `{$module}` WHERE `id` = ?");
                $stmt->execute([$id]);

                foreach ($cfg['fields'] as $name => $field) {

                    if ($field['type'] === 'image') {
                        crud_delete_image(
                            (string) $item[$name],
                            (string) $cfg['image_dir'],
                            $name,
                            $module,
                            $pdo,
                            $app
                        );
                    }
                }

                $response = ['status' => 'success', 'message' => 'Élément supprimé avec succès.'];

                break;
        }

    } catch (CrudUserError $e) {

        crud_cleanup_new_images($newImages, $cfg, $app);

        $response = ['status' => 'error', 'message' => $e->getMessage()];

    } catch (PDOException $e) {

        crud_cleanup_new_images($newImages, $cfg, $app);

        error_log("Erreur BDD module {$module} : " . $e->getMessage());

        $response = ['status' => 'error', 'message' => 'Une erreur de base de données est survenue.'];

    } catch (Throwable $e) {

        crud_cleanup_new_images($newImages, $cfg, $app);

        error_log("Erreur module {$module} : " . $e->getMessage());

        $response = ['status' => 'error', 'message' => 'Une erreur est survenue.'];
    }

    crud_respond($response);
}

/**
 * Supprime les images envoyées pendant une requête qui a finalement échoué.
 */
function crud_cleanup_new_images(array $newImages, array $cfg, array $app): void
{
    foreach ($newImages as $filename) {

        $path = rtrim((string) $app['images_path'], '/\\') . '/' . $cfg['image_dir'] . '/' . $filename;

        if (is_file($path)) {
            @unlink($path);
        }
    }
}
