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

    /**
     * List entries
     *
     * @return array
     */
    public function index(): array
    {
        $leaderboard = $this->competition
                            ->with('competitors')
                            ->get()
                            ->groupBy(function ($competition){
                                return $competition->type . " Km";
                            })
                            ->map( function($competitions) {
                                return $competitions->map( function($competition) {
                                    $competition->competitors = $competition->competitors->sortBy('time');
                                    $competition->competitors = $competition->competitors->map( function($competitor) use ($competition) {
                                        $competitor->entry->position = $competitor->entry->getPosition($competition->competitors);
                                        return $competitor;
                                    });
                                    return $competition;
                                });
                            });
        
        $response = array('data' => []);
        CompetitionResource::withoutWrapping();
        foreach ($leaderboard as $groupBy => $competitions) { 
            $response['data'][$groupBy] = CompetitionResource::collection($competitions);
        }
        return $response;
    }

    /**
     * Leaderboard of a specific competition
     *
     * @param Competition $competition
     * @return CompetitionResource
     */
    public function competition(Competition $competition): CompetitionResource
    {
        $competition = $competition->load('competitors');
        $competition->competitors = $competition->competitors->sortBy('time');
        
        return new CompetitionResource($competition);
    }

    /**
     * Leaderboard of competitions grouped by age
     *
     * @return AnonymousResourceCollection
     */
    public function age(): AnonymousResourceCollection
    {
        $ageGroups = collect([
            '55+ Years' => 55,
            '45 – 55 Years' => 45,
            '35 – 45 Years' => 35,
            '25 – 35 Years' => 25,
            '18 – 25 Years' => 18
        ]);
        $leaderboard = $this->competition
                            ->with('competitors')
                            ->get()
                            ->map( function($competition) use ($ageGroups) {
                                $competition->competitors = $competition->competitors->groupBy(function ($competitor, $key) use ($ageGroups) {
                                    return $ageGroups->search(function($age) use ($competitor) {
                                        return $competitor->age >= $age;
                                    });
                                });

                                $competition->groupBy = $competition->competitors->map( function ($competitorGroup){
                                    $competitorGroup = $competitorGroup->sortBy('time');
                                    $competitorGroup = $competitorGroup->map( function($competitor) use ($competitorGroup) {
                                        $competitor->entry->position = $competitor->entry->getPosition($competitorGroup);
                                        return $competitor;
                                    });
                                    return $competitorGroup;
                                });

                                unset($competition->competitors);
                                return $competition;
                            });

        return CompetitionResource::collection($leaderboard);
    }
}
