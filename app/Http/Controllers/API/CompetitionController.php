<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Http\Resources\CompetitionResource;
use App\Http\Requests\Competition\StoreRequest;
use App\Http\Requests\Competition\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Http\JsonResponse;

class CompetitionController extends Controller
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
     * List competitions
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $competitions = $this->competition->with('competitors')->get();
        return CompetitionResource::collection( $competitions );
    }

    /**
     * Show a competition
     *
     * @param Competition $competition
     * @return CompetitionResource
     */
    public function show(Competition $competition): CompetitionResource
    {
        return new CompetitionResource( $competition->load('competitors') );
    }

    /**
     * Store a new competition
     *
     * @param StoreRequest $request
     * @return CompetitionResource
     */
    public function store(StoreRequest $request): CompetitionResource
    {
        $competition = $this->competition->create($request->all());
        return new CompetitionResource( $competition->load('competitors') );
    }

    /**
     * Update a competition
     *
     * @param UpdateRequest $request
     * @param Competition $competition
     * @return CompetitionResource
     */
    public function update(UpdateRequest $request, Competition $competition): CompetitionResource
    {
        $competition->update($request->all());
        return new CompetitionResource( $competition->load('competitors') );
    }

    /**
     * Delete a competition
     *
     * @param Competition $competition
     * @return JsonResponse
     */
    public function delete(Competition $competition): JsonResponse
    {
        $competition->delete();
        return response()->json( ['message' => 'Succesfully deleted'], 200);
    }
}
