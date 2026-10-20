<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Connexion à la base de données (partagée avec Laravel)
|--------------------------------------------------------------------------
|
| Les identifiants sont lus dans le fichier .env de Laravel (à la racine
| du projet, au-dessus de public/). Ainsi, il n'y a qu'un seul endroit à
| modifier : si le .env change, l'admin PHP suit automatiquement.
|
| Si le .env est introuvable, les valeurs de secours ci-dessous sont utilisées.
|
*/

if (!function_exists('gestion_read_env')) {

    function gestion_read_env(string $file): array
    {
        $values = [];

        if (!is_file($file) || !is_readable($file)) {
            return $values;
        }

        foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $line = trim($line);

            if ($line === '' || $line[0] === '#' || !str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key   = trim($key);
            $value = trim($value);

            // Retirer les guillemets autour de la valeur.
            if (
                strlen($value) >= 2
                && ($value[0] === '"' || $value[0] === "'")
                && substr($value, -1) === $value[0]
            ) {
                $value = substr($value, 1, -1);
            }

            $values[$key] = $value;
        }

        return $values;
    }
}

// gestion/config -> gestion -> public -> racine Laravel (.env)
$env = gestion_read_env(dirname(__DIR__, 3) . '/.env');

$dbHost = $env['DB_HOST']     ?? '127.0.0.1';
$dbPort = $env['DB_PORT']     ?? '3306';
$dbName = $env['DB_DATABASE'] ?? 'erd';
$dbUser = $env['DB_USERNAME'] ?? 'root';
$dbPass = $env['DB_PASSWORD'] ?? '';

$dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
    $dbHost,
    $dbPort,
    $dbName
);

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {

    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);

} catch (PDOException $e) {

    error_log('Erreur connexion BDD : ' . $e->getMessage());

    http_response_code(500);

    exit('Impossible de se connecter à la base de données.');
}
