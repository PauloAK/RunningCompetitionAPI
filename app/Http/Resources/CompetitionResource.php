<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'type'          => $this->type,
            'date'          => $this->date,
            'competitors'   => CompetitorResource::collection( $this->competitors ),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ];
    }
}
