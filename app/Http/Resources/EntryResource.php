<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntryResource extends JsonResource
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
            'id'                => $this->id,
            'competition'       => new CompetitionResource( $this->whenLoaded('competition') ),
            'competitor'        => new CompetitorResource( $this->whenLoaded('competitor') ),
            'start'             => $this->start,
            'finish'            => $this->finish,
            'time'              => $this->time
        ];
    }
}
