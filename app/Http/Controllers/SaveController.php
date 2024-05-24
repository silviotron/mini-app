<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Save;
use App\Models\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function saves()
    {
        $saves = Save::with('results')->orderBy('created_at', 'desc')->paginate(5);
        return view('saves', compact('saves'));
    }
    public function saveResults()
    {
        if (Session::has('search') && Session::has('players') && !empty(Session::get('search')) && !empty(Session::get('players'))) {
            $search = Session::get('search');
            $players = Session::get('players');

            $save = Save::create(['search' => $search]);

            foreach ($players as $playerData) {
                $player = $playerData;

                Result::create([
                    'save_id' => $save->id,
                    'thumbnail' => $player['strThumb'] ?? null,
                    'name' => $player['strPlayer'],
                    'date' => $player['dateBorn'] ?? null,
                    'flag' => $player['flag'] ?? null,
                    'nationality' => $player['strNationality'] ?? null,
                    'team' => $player['strTeam'] ?? null,
                    'equipment' => $player['equipment']['strEquipment'] ?? null,
                    'equipmentSeason' => $player['equipment']['strSeason'] ?? null,
                    'age' => $player['age'] ?? null,
                ]);
            }

            return redirect()->route('search')->with('success', 'Resultados guardados con exito.');
        } else {
            return redirect()->route('search')->with('error', 'No se encontraron datos de búsqueda para guardar.');
        }
    }
}
