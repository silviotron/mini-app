<?php

namespace App\Http\Controllers;

use App\Models\Save;
use App\Models\Result;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SaveController extends Controller
{

    public function clear()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Result::truncate();
        Save::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect('/')->with('success', 'Base de datos vaciada exitosamente.');
    }
    public function home()
    {
        $saves_count = Save::count();
        $results_count = Result::count();
        $search = Save::latest()->value('search');

        $flags = Result::selectRaw('flag, COUNT(*) as flag_count')
            ->groupBy('flag')
            ->orderByDesc('flag_count')
            ->get();

        $ages = Result::selectRaw("IFNULL(age, 'deceased') as age, COUNT(*) as age_count")
            ->groupBy('age')
            ->orderBy('age_count', 'desc')
            ->orderBy('age')
            ->get();

        return view('home', compact('saves_count', 'results_count', 'search', 'flags', 'ages'));
    }
    public function saves()
    {
        $saves = Save::with('results')->orderBy('created_at', 'desc')->paginate(5);
        return view('saves', compact('saves'));
    }
    public function saveResults()
    {
        if (!empty(session('search')) && !empty(session('players'))) {
            $search = session('search');
            $players = session('players');

            session()->forget('players');
            session()->forget('search');

            $save = Save::create(['search' => $search]);

            foreach ($players as $playerData) {
                $player = $playerData;
                if ($player['strTeam'] === '_Deceased Soccer') {
                    $player['age'] = null;
                }

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
