# Qrcode-docker
# API de Gestion de QrCodes

Cette API REST, développée avec Laravel et exécutée dans un environnement Docker, permet de gérer des modèles de QrCodes avec des fonctionnalités CRUD complètes. Chaque qrcode contient des données de son auteur stocker dans le code.

## Table des matières

1. [Fonctionnalités](#fonctionnalités)
2. [Prérequis](#prérequis)
3. [Installation et lancement](#installation-et-lancement)
4. [Endpoints](#endpoints)


## Fonctionnalités

- CRUD complet : Création, lecture, mise à jour et suppression de QrCodes.
- Validation des requêtes : Contrôle côté serveur pour s'assurer que les données sont valides.
- Docker : Configuration Docker pour garantir un environnement homogène.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés :

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Installation et lancement

Suivez ces étapes pour configurer et lancer l'API.

1. Clonez le dépôt :
  
   git clone https://github.com/Adje04/Qrcode-docker.git
   
2. Copiez le fichier d'environnement et modifiez les variables nécessaires :
  
   cp .env.example .env
   
3. Configurez les variables de connexion à la base de données dans le fichier .env si nécessaire. Le fichier Docker compose créera la base de données automatiquement.

4. Lancez le projet avec Docker :
  
   docker-compose up -d --build
   
5. Une fois les conteneurs lancés, exécutez les migrations pour créer les tables nécessaires dans la base de données :
  
   docker-compose exec app php artisan migrate
   
   
L'API sera accessible à l'adresse suivante : http://localhost:8000

## Endpoints

L'API dispose des routes suivantes pour gérer les QrCodes :

| Méthode | Route             | Description             |
| ------- | ------------------| ----------------------- |
| GET     | /api/qrcodes      | Liste des QrCodes       |
| POST    | /api/qrcodes      | Créer un QrCode         |
| GET     | /api/qrcodes/{id} | Obtenir un QrCode       |
| PUT     | /api/qrcodes/{id} | Mettre à jour un QrCode |
| DELETE  | /api/qrcodes/{id} | Supprimer un QrCode     |

Chaque requête doit inclure les données suivantes pour les méthodes POST et PUT :

- author : nom de l'auteur (string, obligatoire).
- data : données du QrCode (string, obligatoire).
