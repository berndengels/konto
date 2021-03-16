<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KontoResource extends JsonResource
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
            'id'                => $this->id,
            'buchungstag'       => $this->buchungstag,
            'buchungstext'      => $this->buchungstext,
            'verwendungszweck'  => $this->verwendungszweck,
            'wer'               => $this->wer,
            'kontonummer'       => $this->kontonummer,
            'blz'               => $this->blz,
            'betrag'            => $this->betrag,
            'waehrung'          => $this->waehrung,
            'info'              => $this->info,
        ];
    }
}
