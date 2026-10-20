# CNAS – Site web de la Caisse Nationale d'Assurance Santé

Site web institutionnel de la CNAS, en deux parties qui partagent la même base de données :

- **le site visiteur**, développé avec **Laravel 10** (routes, contrôleurs, modèles Eloquent, migrations, vues Blade) ;
- **le back-office**, développé en **PHP natif** avec **ChariPHP**, un générateur de back-office que j'ai écrit. Il se trouve dans `public/gestion/` et ne dépend pas de Laravel.

J'ai fait ce choix pour montrer deux manières de travailler : l'organisation d'un framework côté visiteur, et la maîtrise de PHP « pur » (PDO, sessions, protection CSRF, envoi de fichiers) côté administration. Mon autre projet, [Clinique Espoir](https://github.com/khadidja-ahmat/site-web-clinique_espoir), est au contraire entièrement en Laravel.

## Fonctionnalités

### Site visiteur (Laravel)

- Page d'accueil qui rassemble les contenus du site
- Présentation de l'institution, « Mot du directeur », à propos
- Actualités, activités, réalisations
- Galerie d'images
- Directions, organigramme, adresses
- Formulaire de contact (limité à 10 envois par minute et par visiteur)

### Back-office (ChariPHP, dossier `public/gestion`)

- Connexion des administrateurs (jeton CSRF, limitation à 5 tentatives, session régénérée à la connexion, déconnexion après 30 minutes d'inactivité)
- Gestion complète (liste, ajout, modification, suppression) de : messages reçus, actualités, activités, réalisations, galerie, à propos, présentation, président, directions, organigramme, institutions, adresses et administrateurs
- Navigation en AJAX avec tableaux triables (DataTables)
- Envoi d'images contrôlé : type MIME vérifié, image réellement valide, taille limitée à 5 Mo, nom de fichier généré
- Requêtes SQL préparées (PDO) et mots de passe hachés en bcrypt, compatibles avec Laravel

## Technologies

| Partie | Outils |
| --- | --- |
| Site visiteur | PHP 8.1+, Laravel 10, Eloquent, Blade, MySQL |
| Interface visiteur | Bootstrap, jQuery, Owl Carousel, Nivo Slider, Font Awesome (dans `public/lib`) |
| Back-office | PHP natif, PDO, ChariPHP, Bootstrap 5, jQuery, DataTables |
| Tests | PHPUnit (via `php artisan test`) |

## Installation

Prérequis : PHP 8.1 ou plus (extensions `pdo_mysql`, `mbstring`, `fileinfo`), Composer et MySQL ou MariaDB.

```bash
git clone https://github.com/khadidja-ahmat/Site_web_CNAS.git
cd Site_web_CNAS
composer install
cp .env.example .env
php artisan key:generate
```

Créez une base de données vide (par exemple `cnas`), puis ouvrez le fichier `.env` et renseignez :

- `DB_DATABASE`, `DB_USERNAME` et `DB_PASSWORD` pour la base de données ;
- `ADMIN_EMAIL` et `ADMIN_PASSWORD` pour le compte administrateur du back-office (choisissez un mot de passe long et unique ; aucun identifiant n'est écrit dans le code).

Puis lancez :

```bash
php artisan migrate
php artisan db:seed
php artisan serve
```

- Site visiteur : <http://127.0.0.1:8000>
- Back-office : <http://127.0.0.1:8000/gestion/> (les adresses `/login` et `/admin` y redirigent)

Connectez-vous avec l'e-mail et le mot de passe choisis dans `.env`. Le back-office lit lui-même la connexion à la base dans ce même fichier `.env`.

Le site visiteur n'a pas besoin de `npm` : ses fichiers CSS et JavaScript sont déjà dans `public/`. Le back-office charge Bootstrap, jQuery et DataTables depuis des CDN, donc une connexion Internet est nécessaire.

### Images

Les images envoyées depuis le back-office sont enregistrées dans `public/images/<table>/`. Le dépôt contient seulement les dossiers vides : les photos réelles ne sont pas publiées (elles sont ignorées par Git). Une fois connecté au back-office, ajoutez vos propres contenus et images.

## Tests

```bash
php artisan test
```

Les tests vérifient que toutes les pages publiques s'affichent (y compris sur une base vide), que le formulaire de contact enregistre ou rejette un message, et que `/login`, `/admin` et `/dashboard` redirigent vers le back-office.

## Structure du projet

```
app/Http/Controllers/    Contrôleurs du site visiteur
app/Models/              Modèles Eloquent (une table par rubrique)
database/migrations/     Création des tables
database/seeders/        Création du compte administrateur (depuis .env)
resources/views/         Vues Blade du site visiteur
routes/                  Routes (site visiteur et redirections)
public/lib, css, js      Fichiers front du site visiteur
public/gestion/          Back-office ChariPHP (PHP natif)
tests/                   Tests PHPUnit
```

## Mise en ligne

- Définir `APP_ENV=production` et `APP_DEBUG=false` dans `.env`.
- Utiliser HTTPS.
- Le dossier `public/gestion` contient des `.htaccess` qui protègent ses fichiers internes (Apache). Avec Nginx, ajouter une règle `deny all` pour `public/gestion/config` et `public/gestion/includes`.
- Ne jamais publier le fichier `.env`.

## Auteur

Projet réalisé par **Khadidja Ahmat Hassan**.
