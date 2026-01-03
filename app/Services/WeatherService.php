<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;

    // 1. Le Constructeur : Il prépare les outils au démarrage
    public function __construct()
    {
        // On récupère la configuration qu'on vient de définir dans config/services.php
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.base_url');
    }

    // 2. La Méthode principale : Chercher la météo d'une ville
    public function getWeather($city)
    {
        // On envoie une requête GET à l'API
        $response = Http::withoutVerifying()->get($this->baseUrl . 'weather', [
            'q' => $city,           // La ville (ex: 'Paris')
            'appid' => $this->apiKey, // La clé de sécurité
            'units' => 'metric',    // Important : Pour avoir des °C et pas des Kelvin
            'lang' => 'fr'          // Pour avoir "Ciel dégagé" en français
        ]);

        // 3. Gestion des erreurs
        if ($response->successful()) {
            return $response->json(); // Si ça marche, on renvoie les données
        }

        return null; // Si la ville n'existe pas ou erreur, on renvoie rien
    }
}
