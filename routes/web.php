<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

// 1. PAGE D'ACCUEIL (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// 2. DASHBOARD MÉTÉO (Application Vue.js)
Route::get('/meteo', [WeatherController::class, 'index'])->name('meteo');

// 3. RECHERCHE
// Sécurité : Si on tente d'accéder via l'URL (GET), on redirige vers l'accueil
Route::get('/meteo/search', function () { return redirect()->route('meteo'); });
Route::post('/meteo/search', [WeatherController::class, 'search'])->name('meteo.search');

// 4. FAVORIS (AJOUTER / RETIRER)
// Sécurité : Si on tente d'accéder via l'URL (GET), on redirige vers l'accueil
// C'est cette ligne qui corrige ton erreur actuelle :
Route::get('/meteo/toggle', function () { return redirect()->route('meteo'); });
Route::post('/meteo/toggle', [WeatherController::class, 'toggleFavorite'])->name('meteo.toggle');

// 5. SUPPRIMER (Poubelle de la sidebar)
Route::delete('/meteo/favoris/{id}', [WeatherController::class, 'destroy'])->name('meteo.destroy');
