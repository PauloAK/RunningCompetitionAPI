<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Http\Resources\EntryResource;
use App\Http\Requests\Entry\StoreRequest;
use App\Http\Requests\Entry\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EntryController extends Controller
{
    private $entry;

    function __construct()
    {
        $this->entry = new Entry;
    }

    /**
     * List entries
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $entries = $this->entry->with(['competition', 'competitor'])->get();
        return EntryResource::collection( $entries );
    }

    /**
     * Show a entry
     *
     * @return EntryResource
     */
    public function show(Entry $entry): EntryResource
    {
        return new EntryResource( $entry->load(['competitor', 'competition']) );
    }

    /**
     * Store a new entry
     *
     * @return EntryResource
     */
    public function store(StoreRequest $request): EntryResource
    {
        $entry = $this->entry->create($request->all());
        return new EntryResource( $entry->load(['competitor', 'competition']) );
    }

    /**
     * Update a entry
     *
     * @return EntryResource
     */
    public function update(UpdateRequest $request, Entry $entry): EntryResource
    {
        $entry->update($request->all());
        return new EntryResource( $entry->load(['competitor', 'competition']) );
    }

    /**
     * Delete a entry
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Entry $entry): \Illuminate\Http\JsonResponse
    {
        $entry->delete();
        return response()->json( ['message' => 'Succesfully deleted'], 200);
    }
}
