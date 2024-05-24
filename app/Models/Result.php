<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['save_id', 'thumbnail', 'name', 'date', 'flag', 'nationality', 'team', 'equipment', 'equipmentSeason', 'age'];

    public function saveRelation()
    {
        return $this->belongsTo(Save::class);
    }
}
