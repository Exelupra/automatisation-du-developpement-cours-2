# Annuaire d'entreprise

Ce projet est un petit annuaire d'entreprises.  
Il permet de lister plusieurs entreprises, et d'en voir leur bureaux et employées.

## Modification du projet
Pour lancer les commande de l'application, il faut utiliser le script

**Lancer le composer**
`composer install`
**Supprimer et re-créer la base de données**  
`docker compose run --rm php php bin/console db:create`

**Alimenter la base de données**  
`docker compose run --rm php php bin/console db:create`

**Lancer vite.conf afin de mettre à jour les fichiers css et js**
`npm run dev`

**Lancer le docker**
`docker compose up`

## Technologies utilisées
- PHP 8.2
- MariaDB 10
- Slim 4
- Eloquent 10

## Préréquis pour une installation local
- Docker
- Docker compose
- Git

## Installation local
1) Cloner le projet

2) Copier le fichier .env.example en .env, et l'alimenter 
`cp .env.example .env`

3) Installer les dépendances  
`docker compose run --rm php composer install`

4) Lancer le container  
`docker compose up`

## (re)Créer et alimenter la base de données
Il faut que le container database soit lancé pour effectuer ces commandes.

**Supprimer et re-créer la base de données**  
`dexec php bin/console db:create`   

**Alimenter la base de données**  
`dexec php bin/console db:populate`   

## Structure du projet
- **bin** : Contient le script permettant de lancer des commandes. 
- **config** : Contient les fichiers de configuration de l'application.
- **public** : Contient les fichiers accessibles publiquement
    - **assets** : Contient les fichiers css, js, images, etc.
- **src** : Contient le code source de l'application
    - **Console** : Contient les commandes de l'application
    - **Controller** : Contient les contrôleurs de l'application
    - **Models** : Contient les modèles de l'application
    - **Twig** : Contient les extension Twig de l'application
- **view** : Contient les fichiers .twig de l'application

