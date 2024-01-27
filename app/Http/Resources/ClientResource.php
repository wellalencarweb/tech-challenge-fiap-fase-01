<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Src\BoundedContext\Client\Domain\Client;

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

        $data = ['data' => []];

        $resource = $this->resource;

        if ($resource instanceof Client) {
            $data['data'][] = $this->mapDomainClient($resource);
        }

        foreach ($resource as $client) {
            $data['data'][] = $this->mapDomainClient($client);
        }

        return $data;
    }


    #[Pure]
    #[ArrayShape(['name' => "null|string", 'email' => "null|string", 'cpf' => "null|string"])]
    public function mapDomainClient(Client $client): array
    {
        return [
            'id' => $client->id()->value(),
            'name' => $client->name()->value(),
            'email' => $client->email()->value(),
            'cpf' => $client->cpf()->value()
        ];
    }
}
