<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_player')->withPivot('sort_order');
    }
}
