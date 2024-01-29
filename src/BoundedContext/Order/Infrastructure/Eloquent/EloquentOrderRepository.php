<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Infrastructure\Eloquent;

use Src\BoundedContext\Order\Domain\ValueObjects\OrderClientId;
use Src\BoundedContext\Order\Infrastructure\Eloquent\OrderModel as EloquentOrderModel;
use Src\BoundedContext\Order\Infrastructure\Eloquent\OrderItemsModel as EloquentOrderItemsModel;
use Src\BoundedContext\Order\Domain\Contracts\OrderRepositoryContract;
use Src\BoundedContext\Order\Domain\Order;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderCpf;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderEmail;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderName;


final class EloquentOrderRepository implements OrderRepositoryContract
{
    private EloquentOrderModel $eloquentOrderModel;
    private EloquentOrderItemsModel $eloquentOrderItemsModel;

    public function __construct()
    {
        $this->eloquentOrderModel = new EloquentOrderModel;
        $this->eloquentOrderItemsModel = new EloquentOrderItemsModel;
    }

    public function find(OrderId $id): ?Order
    {
        $order = $this->eloquentOrderModel->find($id->value());

        return $this->createDomainOrderModel($order);
    }


    public function findByCriteria(?string $orderStatus): array
    {
        $search = $this->eloquentOrderModel->newQuery();

        $search->select([
            'orders.id',
            'orders.order_status_id',
            'order_status.description as order_status_description',
            'order_items.id as id_ordem_item',
            'orders.client_id',
            'clients.name as client_name',
            'clients.email as client_email',
            'clients.cpf as client_cpf',
            'products.name as product_name',
            'products.description as product_description',
            'products.price as product_price',
            'order_items.quantity'
        ]);

        $search->join('order_items', 'orders.id', '=', 'order_items.order_id');
        $search->join('order_status', 'orders.order_status_id', '=', 'order_status.id');
        $search->join('clients', 'orders.client_id', '=', 'clients.id');
        $search->join('products', 'order_items.product_id', '=', 'products.id');

        if (!is_null($orderStatus)) {
            $search->where('order_status.description', 'LIKE', '%' . $orderStatus . '%');
        }

        $search->orderBy('orders.id');

        return $search->get()->toArray();
    }

    public function save(Order $order): Order
    {
        $newOrder = $this->eloquentOrderModel;

        $data = [
            'client_id' => $order->clientId()->value(),
            'order_status_id' => $order->status(),
        ];

        $dataProducts = $order->products();

        $order = $newOrder->create($data);

        $newOrderItems = $this->eloquentOrderItemsModel;

        $orderItems = [];

        foreach ($dataProducts as $productId) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => 1, //Todo: implementar escolha pelo Client
                'price' => 1 //Todo: implementar busca do preço atual do produto
            ];

            $orderItems[] = $newOrderItems->create($data);
        }

        return $this->createDomainOrderModel($order, $orderItems);
    }

    public function update(Order $order): void
    {
        $orderToUpdate = $this->eloquentOrderModel;

        $data = [
            'name'  => $order->name()->value(),
            'email' => $order->email()->value(),
            'cpf'   => $order->cpf()->value(),
        ];

        $orderToUpdate
            ->findOrFail($order->id()->value())
            ->update($data);
    }

    public function delete(OrderId $id): void
    {
        $this->eloquentOrderModel
            ->findOrFail($id->value())
            ->delete();
    }

    private function createDomainOrderModel(?OrderModel $order, array $orderItems): ?Order
    {
        if (!$order) {
            return null;
        }

        return new Order(
            new OrderId($order->id),
            new OrderClientId($order->client_id),
            $orderItems,
            $order->order_status_id
        );
    }
}
