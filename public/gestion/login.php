<?php
// login.php - Connexion à l'administration
// Authentification sur la table `admins` de Laravel (e-mail + mot de passe bcrypt).

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure'   => isset($_SERVER['HTTPS']),
        'cookie_samesite' => 'Lax',
    ]);
}

$app = require __DIR__ . '/config/app.php';

require_once __DIR__ . '/config/database.php'; // $pdo

// Déjà connecté : direction le Back-Office.
if (isset($_SESSION['user_id'])) {
    header('Location: admin/');
    exit;
}

// Jeton CSRF.
if (empty($_SESSION['_csrf'])) {
    $_SESSION['_csrf'] = bin2hex(random_bytes(32));
}

// Limite d'essais : 5 échecs => blocage de 60 secondes.
const LOGIN_MAX_ATTEMPTS = 5;
const LOGIN_LOCK_SECONDS = 60;

$error_message = '';
$email_value   = '';

if (isset($_GET['expired'])) {
    $error_message = 'Votre session a expiré. Veuillez vous reconnecter.';
}

$lockedUntil = (int) ($_SESSION['login_locked_until'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $csrf     = (string) ($_POST['_csrf'] ?? '');

    $email_value = $email;

    if (empty($_SESSION['_csrf']) || !hash_equals($_SESSION['_csrf'], $csrf)) {

        $error_message = 'Session invalide. Rechargez la page.';

    } elseif ($lockedUntil > time()) {

        $error_message = 'Trop de tentatives. Réessayez dans '
            . ($lockedUntil - time()) . ' secondes.';

    } elseif ($email === '' || $password === '') {

        $error_message = 'Veuillez saisir tous les champs.';

    } else {

        try {

            $stmt = $pdo->prepare('SELECT `id`, `name`, `email`, `password` FROM `admins` WHERE `email` = ? LIMIT 1');
            $stmt->execute([$email]);

            $admin = $stmt->fetch();

            // password_verify lit les hachages bcrypt ($2y$) créés par Laravel.
            if (!$admin || !password_verify($password, (string) $admin['password'])) {

                $_SESSION['login_failures'] = (int) ($_SESSION['login_failures'] ?? 0) + 1;

                if ($_SESSION['login_failures'] >= LOGIN_MAX_ATTEMPTS) {
                    $_SESSION['login_failures']     = 0;
                    $_SESSION['login_locked_until'] = time() + LOGIN_LOCK_SECONDS;
                }

                $error_message = 'Identifiants incorrects.';

            } else {

                // Sécurité : nouvel identifiant de session.
                session_regenerate_id(true);

                $_SESSION['user_id']       = (int) $admin['id'];
                $_SESSION['username']      = (string) $admin['name'];
                $_SESSION['email']         = (string) $admin['email'];
                $_SESSION['role']          = 'admin';
                $_SESSION['last_activity'] = time();
                $_SESSION['_csrf']         = bin2hex(random_bytes(32));

                unset($_SESSION['login_failures'], $_SESSION['login_locked_until']);

                header('Location: admin/');
                exit;
            }

        } catch (PDOException $e) {

            error_log('Login Error: ' . $e->getMessage());

            $error_message = 'Une erreur technique est survenue.';
        }
    }
}

$h = static fn (string $v): string => htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <title>Connexion - <?= $h($app['admin_title']) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="container-fluid p-0 login-container">

        <!-- Volet gauche -->
        <div class="col-lg-7 d-none d-lg-flex login-left">
            <div>
                <h1>Administration</h1>
                <p class="lead mt-3">
                    Panel de gestion du site <?= $h($app['name']) ?>.
                </p>
            </div>
        </div>

        <!-- Volet droit -->
        <div class="col-lg-5 col-12 login-right">

            <div class="login-form">

                <h2 class="mb-2">Accès sécurisé</h2>

                <p class="text-muted mb-4">Veuillez vous authentifier.</p>

                <?php if ($error_message !== ''): ?>
                    <div class="alert alert-danger"><?= $h($error_message) ?></div>
                <?php endif; ?>

                <form method="POST" action="login.php" id="loginForm">

                    <input type="hidden" name="_csrf" value="<?= $h($_SESSION['_csrf']) ?>">

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="<?= $h($email_value) ?>"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            required
                        >
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span class="btn-text">Se connecter</span>
                        </button>
                    </div>

                </form>

                <div class="text-center mt-4">
                    <a href="../" class="small text-muted text-decoration-none">
                        <i class="fa-solid fa-arrow-left me-1"></i>Retour au site
                    </a>
                </div>

            </div>

        </div>

    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.querySelector('.spinner-border').classList.remove('d-none');
            btn.querySelector('.btn-text').textContent = 'Connexion...';
        });
    </script>

</body>
</html>
