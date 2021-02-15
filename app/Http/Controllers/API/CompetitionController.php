<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Http\Resources\CompetitionResource;
use App\Http\Requests\Competition\StoreRequest;
use App\Http\Requests\Competition\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompetitionController extends Controller
{
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
     * @return CompetitionResource
     */
    public function show(Competition $competition): CompetitionResource
    {
        return new CompetitionResource( $competition->load('competitors') );
    }

    /**
     * Store a new competition
     *
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Competition $competition): \Illuminate\Http\JsonResponse
    {
        $competition->delete();
        return response()->json( ['message' => 'Succesfully deleted'], 200);
    }
}
