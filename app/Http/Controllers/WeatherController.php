<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    // Méthode privée pour savoir si une ville est favorite
    private function checkIsFavorite($cityName)
    {
        return Favorite::where('user_id', 1)->where('city', $cityName)->exists();
    }

    public function index()
    {
        $weather = $this->weatherService->getWeather('Agadir');
        $favorites = Favorite::where('user_id', 1)->orderBy('created_at', 'desc')->get();

        // On vérifie si la ville actuelle (Agadir) est dans les favoris
        $isFavorite = $weather ? $this->checkIsFavorite($weather['name']) : false;

        return Inertia::render('WeatherApp', [
            'weatherData' => $weather,
            'favorites' => $favorites,
            'isFavorite' => $isFavorite // <--- On envoie l'info à la vue
        ]);
    }

    public function search(Request $request)
    {
        $request->validate(['city' => 'required|string']);
        $data = $this->weatherService->getWeather($request->city);
        $favorites = Favorite::where('user_id', 1)->orderBy('created_at', 'desc')->get();

        if (!$data) {
            return back()->withErrors(['city' => 'Ville introuvable.']);
        }

        // On vérifie si la ville cherchée est dans les favoris
        $isFavorite = $this->checkIsFavorite($data['name']);

        return Inertia::render('WeatherApp', [
            'weatherData' => $data,
            'favorites' => $favorites,
            'isFavorite' => $isFavorite // <--- On envoie l'info à la vue
        ]);
    }

    // NOUVELLE MÉTHODE : TOGGLE (Ajouter ou Supprimer)
    public function toggleFavorite(Request $request)
    {
        $request->validate(['city_name' => 'required|string']);

        $user = User::first();

        // 1. On cherche et on modifie le favori
        $favorite = $user->favorites()->where('city', $request->city_name)->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Ville retirée des favoris !';
        } else {
            $user->favorites()->create(['city' => $request->city_name]);
            $message = 'Ville ajoutée aux favoris !';
        }

        // 2. CORRECTION MAJEURE ICI 🛠️
        // Au lieu de "return back()", on recharge explicitement la ville en cours.

        // a) On récupère la météo de la ville qu'on vient de modifier (ex: Paris)
        $weather = $this->weatherService->getWeather($request->city_name);

        // b) On récupère la liste des favoris à jour
        $favorites = Favorite::where('user_id', 1)->orderBy('created_at', 'desc')->get();

        // c) On vérifie le statut (est-elle toujours favorite ?)
        $isFavorite = $this->checkIsFavorite($request->city_name);

        // d) On renvoie la vue EXACTEMENT comme si on faisait une recherche
        // Cela force la page à rester sur la ville actuelle
        return Inertia::render('WeatherApp', [
            'weatherData' => $weather,
            'favorites' => $favorites,
            'isFavorite' => $isFavorite,
        ])->with('message', $message); // On passe le message flash
    }

    // Garde la méthode destroy pour la petite poubelle de la sidebar
    public function destroy($id)
    {
        Favorite::where('id', $id)->where('user_id', 1)->delete();
        return back()->with('message', 'Favori supprimé !');
    }
}
