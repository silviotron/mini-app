<?php

namespace App\Http\Controllers;

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
    public function saveResults(Request $request)
    {
        $saveData = $request->only(['search']);
        $players = $request->input('players');

        $save = Save::create($saveData);

        foreach ($players as $playerData) {
            $player = json_decode($playerData, true);

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

        return redirect()->route('search')->with('success', 'Resultados guardados exitosamente.');
    }
}
