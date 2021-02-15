<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competitor;
use App\Http\Resources\CompetitorResource;
use App\Http\Requests\Competitor\StoreRequest;
use App\Http\Requests\Competitor\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompetitorController extends Controller
{
    private $competitor;

    function __construct()
    {
        $this->competitor = new competitor;
    }

    /**
     * List competitors
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $competitors = $this->competitor->all();
        return CompetitorResource::collection( $competitors );
    }

    /**
     * Show a competitor
     *
     * @return CompetitorResource
     */
    public function show(Competitor $competitor): CompetitorResource
    {
        return new CompetitorResource( $competitor );
    }

    /**
     * Store a new competitor
     *
     * @return CompetitorResource
     */
    public function store(StoreRequest $request): CompetitorResource
    {
        $competitor = $this->competitor->create($request->all());
        return new CompetitorResource( $competitor );
    }

    /**
     * Update a competitor
     *
     * @return CompetitorResource
     */
    public function update(UpdateRequest $request, Competitor $competitor): CompetitorResource
    {
        $competitor->update($request->all());
        return new CompetitorResource( $competitor );
    }

    /**
     * Delete a competitor
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Competitor $competitor): \Illuminate\Http\JsonResponse
    {
        $competitor->delete();
        return response()->json( ['message' => 'Succesfully deleted'], 200);
    }
}
