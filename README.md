# 🌤️ SkyCast - Application Météo VILT

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)
![Inertia](https://img.shields.io/badge/Inertia-9553E9?style=for-the-badge&logo=inertia&logoColor=white)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

## 📖 Description

**SkyCast** est une application météo moderne et immersive développée dans le cadre d'un projet d'ingénierie. Elle démontre la puissance de l'architecture **VILT** (Vue, Inertia, Laravel, Tailwind) en offrant une expérience **SPA (Single Page Application)** ultra-rapide, sans rechargement de page.

Le projet se distingue par son interface "Human-Centric" : le design change dynamiquement selon la météo et l'application interagit avec l'utilisateur via des messages contextuels.

## ✨ Fonctionnalités Principales

### 🎨 UI/UX & Design
* **Glassmorphism** : Interface moderne utilisant la transparence et le flou (backdrop-filter) pour une esthétique premium.
* **Ambiance Dynamique** : L'arrière-plan de l'application s'adapte en temps réel aux conditions (Ciel bleu, Nuit violette, Pluie grise, Orage sombre, etc.).
* **Assistant Intelligent** : Messages personnalisés basés sur la température et les conditions (ex: *"N'oubliez pas votre parapluie"* ou *"Sortez les lunettes de soleil"*).

### ⚡ Technique & Fonctionnel
* **Architecture Hybride** : Landing page en **Blade** (SEO) et Dashboard en **Vue.js/Inertia** (Réactivité).
* **Recherche Temps Réel** : Connexion à l'API **OpenWeatherMap** pour des données mondiales.
* **Système de Favoris (SQLite)** :
    * Bouton "Toggle" intelligent (Ajouter/Retirer) avec changement d'état visuel.
    * Sidebar latérale persistante listant les villes sauvegardées.
    * Suppression sécurisée avec **Modale de confirmation** personnalisée (Vue.js).

## 🛠️ Stack Technique

* **Backend** : Laravel 10+ (PHP 8.2+)
* **Frontend** : Vue.js 3 (Composition API)
* **Routing** : Inertia.js (Pas d'API REST complexe, routing classique Laravel)
* **Style** : Tailwind CSS
* **Base de Données** : SQLite (Léger et portable)
* **API Externe** : OpenWeatherMap

## 🚀 Installation Locale

Suivez ces étapes pour lancer le projet sur votre machine.

### 1. Pré-requis
* PHP 8.2+
* Composer
* Node.js & NPM

### 2. Cloner le projet
```bash
git clone [https://github.com/VOTRE-NOM-UTILISATEUR/SkyCast-Meteo-VILT.git](https://github.com/VOTRE-NOM-UTILISATEUR/SkyCast-Meteo-VILT.git)
cd SkyCast-Meteo-VILT
3. Installer les dépendances
Bash

# Backend
composer install

# Frontend
npm install

4. Configuration de l'environnement
Copiez le fichier d'exemple et générez la clé de cryptage :

Bash

cp .env.example .env
php artisan key:generate
⚠️ Configuration API : Ouvrez le fichier .env et ajoutez votre clé OpenWeatherMap :

Ini, TOML

OPENWEATHER_API_KEY=votre_cle_api_ici
DB_CONNECTION=sqlite
