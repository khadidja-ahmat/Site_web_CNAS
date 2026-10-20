<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Protection de l'administration
|--------------------------------------------------------------------------
|
| Vérifie que l'administrateur est connecté et que sa session n'a pas
| expiré. Pour les requêtes AJAX (modules), on répond 401 au lieu de
| rediriger, afin que le JavaScript puisse renvoyer vers la connexion.
|
*/

if (session_status() !== PHP_SESSION_ACTIVE) {

    session_start([
        'cookie_httponly' => true,
        'cookie_secure'   => isset($_SERVER['HTTPS']),
        'cookie_samesite' => 'Lax',
    ]);
}

$app = require __DIR__ . '/app.php';

date_default_timezone_set($app['timezone'] ?? 'UTC');

// URL de la page de connexion (calculée depuis l'URL du script courant).
$scriptName    = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$adminPosition = strpos($scriptName, '/admin/');

$baseUrl  = $adminPosition !== false ? substr($scriptName, 0, $adminPosition) : '';
$loginUrl = $baseUrl . '/login.php';

$isAjax = defined('GESTION_JSON')
    || strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest';

$denyAccess = static function (string $suffix = '') use ($isAjax, $loginUrl): void {

    if ($isAjax) {
        http_response_code(401);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status' => 'error', 'message' => 'Vous devez être connecté.']);
        exit;
    }

    header('Location: ' . $loginUrl . $suffix);
    exit;
};

// Utilisateur connecté ?
if (empty($_SESSION['user_id'])) {
    $denyAccess();
}

// Expiration de session.
$sessionLifetime = (int) ($app['session_lifetime'] ?? 1800);

if (
    isset($_SESSION['last_activity'])
    && (time() - (int) $_SESSION['last_activity']) > $sessionLifetime
) {
    $_SESSION = [];
    session_destroy();
    $denyAccess('?expired=1');
}

$_SESSION['last_activity'] = time();

// Jeton CSRF disponible pour toute la session.
if (empty($_SESSION['_csrf'])) {
    $_SESSION['_csrf'] = bin2hex(random_bytes(32));
}

$currentUser = [
    'id'       => (int) ($_SESSION['user_id'] ?? 0),
    'username' => (string) ($_SESSION['username'] ?? ''),
    'email'    => (string) ($_SESSION['email'] ?? ''),
    'role'     => (string) ($_SESSION['role'] ?? ''),
];
