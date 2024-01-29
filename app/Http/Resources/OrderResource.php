<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Src\BoundedContext\Order\Domain\Order;

class OrderResource extends JsonResource
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

        if ($resource instanceof Order) {
            $data['data'][] = $this->mapDomainOrder($resource);
        }

        foreach ($resource as $order) {
            $data['data'][] = $this->mapDomainOrder($order);
        }

        return $data;
    }


    #[Pure]
    #[ArrayShape(['name' => "null|string", 'email' => "null|string", 'cpf' => "null|string"])]
    public function mapDomainOrder(Order $order): array
    {
        return [
            'id' => $order->id()->value(),
            'name' => $order->name()->value(),
            'email' => $order->email()->value(),
            'cpf' => $order->cpf()->value()
        ];
    }
}
