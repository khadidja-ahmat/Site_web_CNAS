# Administration PHP (ChariPHP) pour le site Laravel « caisse »

Le site visiteur reste en Laravel, sans aucune modification.
Ce dossier ajoute un back-office en PHP, branché sur la **même base de données** (`erd`).

## Installation

1. Copier le dossier `gestion/` dans `caisse/public/` :

       caisse/
       ├── .env
       └── public/
           ├── images/        (existant : images du site)
           ├── gestion/       <-- ce dossier
           └── index.php      (Laravel)

2. Ouvrir `http://<votre-site>/gestion/` (en local avec `php artisan serve` :
   `http://127.0.0.1:8000/gestion/`).

3. Se connecter avec un compte de la table `admins` de Laravel
   (e-mail + mot de passe habituels de l'admin Laravel).

Rien d'autre à configurer : la connexion MySQL est lue automatiquement dans le
`.env` de Laravel (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

> Le dossier s'appelle `gestion` (et pas `admin`) car Laravel utilise déjà
> l'adresse `/admin` pour son propre back-office.

## Ce que l'admin gère

Messages reçus (lecture/suppression), Actualités, Activités, Réalisations, Galerie,
À propos, Présentation, Président, Directions, Organigramme, Institutions,
Adresses, Administrateurs. Les tables `students` et `users` ne sont pas incluses.

- Les images envoyées sont enregistrées dans `public/images/<table>/`, avec un nom
  de fichier au format Laravel : le site les affiche sans rien changer.
- `created_at` / `updated_at` sont remplis (en UTC, comme Laravel) : les
  `latest()` du site continuent de fonctionner.
- Les mots de passe des administrateurs sont hachés en bcrypt (`$2y$`),
  lisibles par l'admin Laravel et inversement.

## Ajouter ou modifier une table

- **Modifier les champs d'une table** : `config/tables.php` (une entrée par table).
- **Ajouter une table** : ajouter son entrée dans `config/tables.php`, copier le dossier
  d'un module existant dans `admin/modules/` (en changeant le nom dans les 2 fichiers),
  puis ajouter l'onglet dans `config/modules.php` avant la ligne `// CHARI_MODULES_HERE`.

## Pré-requis

PHP 8.1 ou plus (extensions `pdo_mysql`, `mbstring`, `fileinfo`), MySQL/MariaDB.
Bootstrap, jQuery et DataTables sont chargés depuis des CDN : une connexion Internet est nécessaire.

## Sécurité

- Utiliser HTTPS en production.
- Les `.htaccess` de `config/` et `includes/` bloquent l'accès direct (Apache).
  Avec Nginx, ajouter une règle `deny all` équivalente pour ces deux dossiers.
- Sessions : déconnexion après 30 minutes d'inactivité (`config/app.php`).
