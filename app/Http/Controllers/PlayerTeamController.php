<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerTeamController extends Controller
{
    public function updateOrder(Request $request)
    {
        $request->validate([
            'teams' => 'required|array',
            'teams.*.team_id' => 'required|exists:teams,id',
            'teams.*.players' => 'required|array',
            'teams.*.players.*.player_id' => 'required|exists:players,id',
            'teams.*.players.*.sort_order' => 'required|integer',
        ]);

        foreach ($request->teams as $teamData) {
            $team = Team::find($teamData['team_id']);

            $syncData = [];
            foreach ($teamData['players'] as $playerData) {
                $syncData[$playerData['player_id']] = ['sort_order' => $playerData['sort_order']];
            }

            $team->players()->sync($syncData);
        }

        return response()->json(['message' => 'Teams and players saved successfully.']);
    }
}
