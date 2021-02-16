<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Http\Resources\CompetitionResource;

class LeaderboardController extends Controller
{
    /**
     * @var Competition
     */
    private $competition;

    function __construct()
    {
        $this->competition = new Competition;
    }

    public function index()
    {
        $leaderboard = $this->competition
                            ->with('competitors')
                            ->get()
                            ->map( function($competition) {
                                $competition->competitors = $competition->competitors->sortBy('time');
                                return $competition;
                            });

        return CompetitionResource::collection($leaderboard);
    }
}
