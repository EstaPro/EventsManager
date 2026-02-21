<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    /**
     * Returns all sessions ordered by start time, with speakers included.
     */
    public function index()
    {
        $sessions = Conference::with('speakers')
            ->orderBy('start_time', 'asc')
            ->get();

        return response()->json($sessions);
    }
}
