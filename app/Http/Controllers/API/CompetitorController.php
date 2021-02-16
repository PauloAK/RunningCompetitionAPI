<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competitor;
use App\Http\Resources\CompetitorResource;
use App\Http\Requests\Competitor\StoreRequest;
use App\Http\Requests\Competitor\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Http\JsonResponse;

class CompetitorController extends Controller
{
    /**
     * @var Competitor
     */
    private $competitor;

    function __construct()
    {
        $this->competitor = new Competitor;
    }

    /**
     * List competitors
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $competitors = $this->competitor->with('competitions')->get();
        return CompetitorResource::collection( $competitors );
    }

    /**
     * Show a competitor
     *
     * @param Competitor $competitor
     * @return CompetitorResource
     */
    public function show(Competitor $competitor): CompetitorResource
    {
        return new CompetitorResource( $competitor->load('competitions') );
    }

    /**
     * Store a new competitor
     *
     * @param StoreRequest $request
     * @return CompetitorResource
     */
    public function store(StoreRequest $request): CompetitorResource
    {
        $competitor = $this->competitor->create($request->all());
        return new CompetitorResource( $competitor->load('competitions') );
    }

    /**
     * Update a competitor
     *
     * @param UpdateRequest $request
     * @param Competitor $competitor
     * @return CompetitorResource
     */
    public function update(UpdateRequest $request, Competitor $competitor): CompetitorResource
    {
        $competitor->update($request->all());
        return new CompetitorResource( $competitor->load('competitions') );
    }

    /**
     * Delete a competitor
     *
     * @param Competitor $competitor
     * @return JsonResponse
     */
    public function delete(Competitor $competitor): JsonResponse
    {
        $competitor->delete();
        return response()->json( ['message' => 'Succesfully deleted'], 200);
    }
}
