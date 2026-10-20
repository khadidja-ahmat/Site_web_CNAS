<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Onglets de l'administration (ordre = ordre du menu)
|--------------------------------------------------------------------------
|
| Le contenu de chaque onglet est décrit dans config/tables.php.
| Le marqueur CHARI_MODULES_HERE en bas du fichier est utilisé par
| le générateur ChariPHP (forge.php) pour ajouter de nouveaux modules.
|
*/

return [

    'dashboard' => [
        'label' => 'Tableau de bord',
        'icon'  => 'fa-solid fa-chart-line',
        'roles' => ['admin'],
    ],

    'contacts' => [
        'label' => 'Messages',
        'icon'  => 'fa-solid fa-envelope',
        'roles' => ['admin'],
    ],

    'actualites' => [
        'label' => 'Actualités',
        'icon'  => 'fa-solid fa-newspaper',
        'roles' => ['admin'],
    ],

    'activites' => [
        'label' => 'Activités',
        'icon'  => 'fa-solid fa-person-running',
        'roles' => ['admin'],
    ],

    'realisations' => [
        'label' => 'Réalisations',
        'icon'  => 'fa-solid fa-trophy',
        'roles' => ['admin'],
    ],

    'galeries' => [
        'label' => 'Galerie',
        'icon'  => 'fa-solid fa-images',
        'roles' => ['admin'],
    ],

    'abouts' => [
        'label' => 'À propos',
        'icon'  => 'fa-solid fa-circle-info',
        'roles' => ['admin'],
    ],

    'presentations' => [
        'label' => 'Présentation',
        'icon'  => 'fa-solid fa-display',
        'roles' => ['admin'],
    ],

    'presidents' => [
        'label' => 'Président',
        'icon'  => 'fa-solid fa-user-tie',
        'roles' => ['admin'],
    ],

    'directions' => [
        'label' => 'Directions',
        'icon'  => 'fa-solid fa-sitemap',
        'roles' => ['admin'],
    ],

    'organigrammes' => [
        'label' => 'Organigramme',
        'icon'  => 'fa-solid fa-diagram-project',
        'roles' => ['admin'],
    ],

    'institutions' => [
        'label' => 'Institutions',
        'icon'  => 'fa-solid fa-building-columns',
        'roles' => ['admin'],
    ],

    'adresses' => [
        'label' => 'Adresses',
        'icon'  => 'fa-solid fa-location-dot',
        'roles' => ['admin'],
    ],

    'admins' => [
        'label' => 'Administrateurs',
        'icon'  => 'fa-solid fa-user-shield',
        'roles' => ['admin'],
    ],

    // CHARI_MODULES_HERE
];
