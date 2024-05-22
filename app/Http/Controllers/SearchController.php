<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $search = $request->search;

        $response = Http::get('www.thesportsdb.com/api/v1/json/3/searchplayers.php', [
            'p' => $search
        ]);

        $all = $response->json();

        // Filtrar jugadores de Futbol
        $soccerPlayers = isset($all['player']) ? array_filter($all['player'], function ($player) {
            return isset($player['strSport']) && $player['strSport'] === 'Soccer';
        }) : [];

        $players = array_slice($soccerPlayers, 0, 5);

        return view('search', compact('players', 'search'));
    }
}
