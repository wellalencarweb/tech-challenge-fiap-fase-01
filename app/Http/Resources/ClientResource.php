<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray(Request $request)
    {
        // Map Domain Client model values
        return [
            'data' => [
                'name' => $this->name()->value(),
                'email' => $this->email()->value(),
                'cpf' => $this->cpf()->value()
            ]
        ];
    }
}
