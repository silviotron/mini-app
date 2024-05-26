<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        if (!isset($request->search)) {
            return view('search');
        }
        try {
            $search = $request->search;

            $response = Http::get('https://www.thesportsdb.com/api/v1/json/3/searchplayers.php', [
                'p' => $search
            ]);
            $all = $response->json();

            // Filtrar jugadores de Futbol
            $soccerPlayers = isset($all['player']) ? array_filter($all['player'], function ($player) {
                return isset($player['strSport']) && $player['strSport'] === 'Soccer';
            }) : [];

            $players = array_slice($soccerPlayers, 0, 5);

            //obtener codigos de pais
            $flagsResponse = Http::get('https://flagcdn.com/en/codes.json');
            $flags = array_flip($flagsResponse->json());
            $flags['Republic of Ireland'] = 'ie';
            $flags['The Netherlands'] = 'nl';
            foreach ($players as $index => $player) {
                //calcular edad
                $dateOfBirth = $player['dateBorn'];
                if ($player['strTeam'] === '_Deceased Soccer') {
                    $age = null;
                } else {
                    $age = $this->calculateAge($dateOfBirth);
                }
                $players[$index]['age'] = $age;

                //obtener bandera
                if (isset($flags[$player['strNationality']])) {
                    $players[$index]['flag'] = 'https://flagcdn.com/h24/' . $flags[$player['strNationality']] . '.webp';
                } else {
                    $players[$index]['flag'] = asset('world.png');
                }


                // Obtener la equipacion
                $equipmentResponse = Http::get('https://www.thesportsdb.com/api/v1/json/3/lookupequipment.php', [
                    'id' => $player['idTeam']
                ]);
                $jerseys = $equipmentResponse->json()['equipment'] ?? null;
                if (!empty($jerseys)) {
                    $filteredJerseys = array_filter($jerseys, function ($jersey) {
                        return isset($jersey['strType']) && $jersey['strType'] === '1st';
                    });
                    if (!empty($filteredJerseys)) {
                        usort($filteredJerseys, function ($a, $b) {
                            return strtotime($a['date']) - strtotime($b['date']);
                        });
                        $players[$index]['equipment'] = end($filteredJerseys);
                    } else {
                        $players[$index]['equipment'] = null;
                    }
                } else {
                    $players[$index]['equipment'] = null;
                }
            }

            session(['players' => $players]);
            session(['search' => $search]);

            return view('search', compact('players', 'search'));
        } catch (\Exception $e) {
            return redirect()->route('search')->with('error', 'Error en la búsqueda.');
        }
    }

    public function calculateAge($dateOfBirth)
    {
        $currentDate = time();
        $dateOfBirth = strtotime($dateOfBirth);

        $age = date('Y', $currentDate) - date('Y', $dateOfBirth);

        if (date('md', $currentDate) < date('md', $dateOfBirth)) {
            $age--;
        }

        return $age;
    }
}
