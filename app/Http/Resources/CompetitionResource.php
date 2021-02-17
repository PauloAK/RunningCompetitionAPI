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
            $this->mergeWhen($this->resource->relationLoaded('competitors'), [
                'competitors' => CompetitorResource::collection( $this->competitors )
            ]),
            $this->mergeWhen($this->groupBy, function(){
                $array = array('competitors' => [] );
                foreach ($this->groupBy as $group => $competitors) {
                    $array['competitors'][$group] = CompetitorResource::collection($competitors);
                }
                return $array;
            }),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ];
    }
}
