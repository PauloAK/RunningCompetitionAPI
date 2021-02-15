<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompetitorResource extends JsonResource
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
            'name'          => $this->name,
            'cpf'           => $this->cpf,
            'birthdate'     => $this->birthdate,
            'age'           => $this->age,
            'competitions'  => CompetitionResource::collection( $this->whenLoaded('competitions') ),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ];
    }
}
