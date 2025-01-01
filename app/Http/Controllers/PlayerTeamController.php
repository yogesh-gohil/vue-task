<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerTeamController extends Controller
{
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'team_id' => 'required|exists:teams,id',
        ]);

        $player = Player::find($request->player_id);
        $team = Team::find($request->team_id);

        // Attach the player to the team
        $team->players()->attach($player);

        return response()->json([
            'message' => 'Player successfully added to team!',
        ]);
    }

    public function remove(Request $request)
    {
        // Validate input
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'team_id' => 'required|exists:teams,id',
        ]);

        $player = Player::find($request->player_id);
        $team = Team::find($request->team_id);

        // Detach the player from the team
        $team->players()->detach($player);

        return response()->json([
            'message' => 'Player successfully removed from team!',
        ]);
    }
}
