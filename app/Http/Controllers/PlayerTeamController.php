<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderRequest;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerTeamController extends Controller
{
    public function updateOrder(UpdateOrderRequest $request)
    {
        $validatedData = $request->validated();

        foreach ($validatedData['teams'] as $teamData) {
            $team = Team::findOrFail($teamData['team_id']);

            $team->players()->sync($teamData['players']);
        }

        return response()->json(['message' => 'Teams and players saved successfully.']);
    }
}
