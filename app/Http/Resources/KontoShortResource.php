<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KontoShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'buchungstag'   => $this->buchungstag,
            'buchungstext'  => $this->buchungstext,
            'wer'           => $this->wer,
            'betrag'        => $this->betrag,
        ];
    }
}
