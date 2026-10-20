<?php
// /logout.php - Déconnexion sécurisée (POST + jeton CSRF)

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure'   => isset($_SERVER['HTTPS']),
        'cookie_samesite' => 'Lax',
    ]);
}

// La déconnexion doit venir du bouton de déconnexion.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$csrf = $_POST['_csrf'] ?? '';

if (
    empty($_SESSION['_csrf'])
    || !is_string($csrf)
    || !hash_equals($_SESSION['_csrf'], $csrf)
) {
    http_response_code(403);
    exit('Requête de déconnexion invalide.');
}

$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

session_destroy();

header('Location: login.php');
exit;
