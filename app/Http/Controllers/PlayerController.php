<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'players' => Player::all()
        ]);
    }
}
