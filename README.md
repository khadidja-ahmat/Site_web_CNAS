# Site Web de la Caisse Nationale d'Assurance Sante

Ce projet est une application web developpee avec Laravel pour presenter la Caisse Nationale d'Assurance Sante (CNAS). Le site permet de publier et gerer les informations importantes de l'institution, notamment les actualites, les activites, les realisations, les galeries, les directions, les contacts et les informations de presentation.

## Objectif du projet

L'objectif principal de ce site est de faciliter l'acces aux informations de la CNAS et de proposer une interface d'administration permettant de mettre a jour le contenu du site de maniere simple.

## Fonctionnalites principales

- Presentation de la CNAS
- Gestion des actualites
- Gestion des activites
- Gestion des realisations
- Gestion des galeries d'images
- Gestion des directions et adresses
- Gestion des contacts
- Espace d'administration
- Authentification des administrateurs

## Technologies utilisees

- Laravel
- PHP
- MySQL
- Blade
- Bootstrap
- JavaScript
- CSS

## Installation du projet

Cloner le projet :

```bash
git clone https://github.com/khadidja-ahmat/Site_web_CNAS.git
```

Entrer dans le dossier du projet :

```bash
cd Site_web_CNAS
```

Installer les dependances PHP :

```bash
composer install
```

Installer les dependances JavaScript :

```bash
npm install
```

Copier le fichier d'environnement :

```bash
cp .env.example .env
```

Generer la cle de l'application :

```bash
php artisan key:generate
```

Configurer la base de donnees dans le fichier `.env`, puis lancer les migrations :

```bash
php artisan migrate
```

Lancer le serveur local :

```bash
php artisan serve
```

## Auteur

Projet realise par Khadidja Ahmat Hassan.
