<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Configuration générale de l'administration
|--------------------------------------------------------------------------
*/

return [

    'name'        => 'Caisse',
    'admin_title' => 'Administration - Caisse',

    // Module affiché à l'ouverture de l'administration.
    'default_admin_module' => 'dashboard',

    // Durée d'inactivité maximale avant déconnexion (secondes).
    'session_lifetime' => 1800,

    // Les dates created_at / updated_at de Laravel sont en UTC
    // (config/app.php de Laravel : 'timezone' => 'UTC').
    'timezone' => 'UTC',

    // Dossier des images du site Laravel (public/images).
    // gestion/config -> gestion -> public -> public/images
    'images_path' => dirname(__DIR__, 2) . '/images',

    // Taille maximale d'une image envoyée (en octets) : 5 Mo.
    'max_upload_size' => 5 * 1024 * 1024,

];
