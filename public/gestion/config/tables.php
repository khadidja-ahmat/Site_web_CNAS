<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Tables gérées par l'administration
|--------------------------------------------------------------------------
|
| Une entrée = un module. La clé est le nom du module ET de la table MySQL.
|
| Types de champ disponibles :
|   text      champ texte sur une ligne
|   email     adresse e-mail (validée)
|   textarea  texte long
|   image     envoi d'image (enregistrée dans public/images/<image_dir>/,
|             seul le nom du fichier est stocké en base, comme Laravel)
|   password  mot de passe (haché en bcrypt, compatible avec Laravel)
|
| Options d'un champ :
|   label     libellé affiché
|   required  obligatoire (true/false)
|   max       longueur maximale (reprend la taille de la colonne MySQL)
|   list      afficher la colonne dans le tableau (true/false)
|
| Options d'un module :
|   readonly  true = consultation et suppression seulement (pas d'ajout
|             ni de modification) : utilisé pour les messages de contact.
|
| Pour ajouter une table (ex. students) : copier une entrée, créer le
| dossier admin/modules/<table>/ (index.php + ajax_handler.php identiques
| aux autres), puis ajouter l'onglet dans config/modules.php.
|
*/

return [

    'abouts' => [
        'label'     => 'À propos',
        'singular'  => 'une section À propos',
        'icon'      => 'fa-solid fa-circle-info',
        'image_dir' => 'abouts',
        'fields'    => [
            'titre'       => ['label' => 'Titre',       'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'image'       => ['label' => 'Image',       'type' => 'image',    'required' => true, 'list' => true],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'list' => true],
        ],
    ],

    'activites' => [
        'label'     => 'Activités',
        'singular'  => 'une activité',
        'icon'      => 'fa-solid fa-person-running',
        'image_dir' => 'activites',
        'fields'    => [
            'titre'       => ['label' => 'Titre',       'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'image'       => ['label' => 'Image',       'type' => 'image',    'required' => true, 'list' => true],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => true],
        ],
    ],

    'actualites' => [
        'label'     => 'Actualités',
        'singular'  => 'une actualité',
        'icon'      => 'fa-solid fa-newspaper',
        'image_dir' => 'actualites',
        'fields'    => [
            'titre'       => ['label' => 'Titre',       'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'image'       => ['label' => 'Image',       'type' => 'image',    'required' => true, 'list' => true],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => true],
            'details'     => ['label' => 'Détails',     'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => false],
        ],
    ],

    'directions' => [
        'label'     => 'Directions',
        'singular'  => 'une direction',
        'icon'      => 'fa-solid fa-sitemap',
        'image_dir' => 'directions',
        'fields'    => [
            'titre'       => ['label' => 'Titre',       'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'image'       => ['label' => 'Image',       'type' => 'image',    'required' => true, 'list' => true],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => true],
            'detail'      => ['label' => 'Détail',      'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => false],
        ],
    ],

    'galeries' => [
        'label'     => 'Galerie',
        'singular'  => 'une image de galerie',
        'icon'      => 'fa-solid fa-images',
        'image_dir' => 'galeries',
        'fields'    => [
            'titre'       => ['label' => 'Titre',       'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'image'       => ['label' => 'Image',       'type' => 'image',    'required' => true, 'list' => true],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => true],
        ],
    ],

    'realisations' => [
        'label'     => 'Réalisations',
        'singular'  => 'une réalisation',
        'icon'      => 'fa-solid fa-trophy',
        'image_dir' => 'realisations',
        'fields'    => [
            'titre'       => ['label' => 'Titre',       'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'image'       => ['label' => 'Image',       'type' => 'image',    'required' => true, 'list' => true],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => true],
        ],
    ],

    'presidents' => [
        'label'     => 'Président',
        'singular'  => 'un président',
        'icon'      => 'fa-solid fa-user-tie',
        'image_dir' => 'presidents',
        'fields'    => [
            'titre'       => ['label' => 'Titre',       'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'image'       => ['label' => 'Image',       'type' => 'image',    'required' => true, 'list' => true],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => true],
        ],
    ],

    'organigrammes' => [
        'label'     => 'Organigramme',
        'singular'  => 'un organigramme',
        'icon'      => 'fa-solid fa-diagram-project',
        'image_dir' => 'organigrammes',
        'fields'    => [
            'image' => ['label' => 'Image', 'type' => 'image', 'required' => true, 'list' => true],
        ],
    ],

    'presentations' => [
        'label'     => 'Présentation',
        'singular'  => 'une présentation',
        'icon'      => 'fa-solid fa-display',
        'image_dir' => null,
        'fields'    => [
            'description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => true],
        ],
    ],

    'institutions' => [
        'label'     => 'Institutions',
        'singular'  => 'une institution',
        'icon'      => 'fa-solid fa-building-columns',
        'image_dir' => null,
        'fields'    => [
            'titre'       => ['label' => 'Titre',       'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => true],
        ],
    ],

    'adresses' => [
        'label'     => 'Adresses',
        'singular'  => 'une adresse',
        'icon'      => 'fa-solid fa-location-dot',
        'image_dir' => null,
        'fields'    => [
            'tel'     => ['label' => 'Téléphone', 'type' => 'text',  'required' => true, 'max' => 255, 'list' => true],
            'heure'   => ['label' => 'Horaires',  'type' => 'text',  'required' => true, 'max' => 255, 'list' => true],
            'email'   => ['label' => 'E-mail',    'type' => 'email', 'required' => true, 'max' => 255, 'list' => true],
            'site'    => ['label' => 'Site web',  'type' => 'text',  'required' => true, 'max' => 255, 'list' => false],
            'adresse' => ['label' => 'Adresse',   'type' => 'text',  'required' => true, 'max' => 255, 'list' => true],
            'lieu'    => ['label' => 'Lieu',      'type' => 'text',  'required' => true, 'max' => 255, 'list' => false],
        ],
    ],

    // Messages envoyés par les visiteurs depuis le site : lecture et suppression seulement.
    'contacts' => [
        'label'     => 'Messages',
        'singular'  => 'un message',
        'icon'      => 'fa-solid fa-envelope',
        'image_dir' => null,
        'readonly'  => true,
        'fields'    => [
            'nom'     => ['label' => 'Nom',     'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'email'   => ['label' => 'E-mail',  'type' => 'email',    'required' => true, 'max' => 255, 'list' => true],
            'objet'   => ['label' => 'Objet',   'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'message' => ['label' => 'Message', 'type' => 'textarea', 'required' => true, 'max' => 255, 'list' => true],
        ],
    ],

    // Administrateurs : même table que l'admin Laravel (guard "admin").
    'admins' => [
        'label'     => 'Administrateurs',
        'singular'  => 'un administrateur',
        'icon'      => 'fa-solid fa-user-shield',
        'image_dir' => null,
        'fields'    => [
            'name'     => ['label' => 'Nom',          'type' => 'text',     'required' => true, 'max' => 255, 'list' => true],
            'email'    => ['label' => 'E-mail',       'type' => 'email',    'required' => true, 'max' => 255, 'list' => true],
            'password' => ['label' => 'Mot de passe', 'type' => 'password', 'required' => true, 'max' => 255, 'list' => false],
        ],
    ],

];
