<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Infrastructure\Eloquent;

use Src\BoundedContext\Order\Infrastructure\Eloquent\OrderModel as EloquentOrderModel;
use Src\BoundedContext\Order\Domain\Contracts\OrderRepositoryContract;
use Src\BoundedContext\Order\Domain\Order;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderCpf;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderEmail;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderName;


final class EloquentOrderRepository implements OrderRepositoryContract
{
    private EloquentOrderModel $eloquentOrderModel;

    public function __construct()
    {
        $this->eloquentOrderModel = new EloquentOrderModel;
    }

    public function find(OrderId $id): ?Order
    {
        $order = $this->eloquentOrderModel->find($id->value());

        return $this->createDomainOrderModel($order);
    }


    public function findByCriteria(?OrderName $orderName, ?OrderEmail $orderEmail, ?OrderCpf $orderCpf): array
    {
        $orders = [];

        $search = $this->eloquentOrderModel->newQuery();

        if (!is_null($orderName->value())) {
            $search->where('name', $orderName->value());
        }

        if (!is_null($orderEmail->value())) {
            $search->where('email', $orderEmail->value());
        }

        if (!is_null($orderCpf->value())) {
            $search->where('cpf', $orderCpf->value());
        }

        $ordersList = $search->get();

        foreach ($ordersList as $order){
            $orders[] = $this->createDomainOrderModel($order);
        }

        return $orders;
    }

    public function save(Order $order): Order
    {
        $newOrder = $this->eloquentOrderModel;

        $data = [
            'name' => $order->name()->value(),
            'email' => $order->email()->value(),
            'cpf' => $order->cpf()->value(),
        ];

        $order = $newOrder->create($data);

        return $this->createDomainOrderModel($order);
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

    private function createDomainOrderModel(?OrderModel $order): ?Order
    {
        if (!$order) {
            return null;
        }

        return new Order(
            new OrderId($order->id),
            new OrderName($order->name),
            new OrderEmail($order->email),
            new OrderCpf($order->cpf)
        );
    }
}
