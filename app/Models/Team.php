<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    use HasFactory;

    public function players()
    {
        return $this->belongsToMany(Player::class, 'team_player')->withPivot('sort_order')->orderBy('pivot_sort_order');
    }
}
