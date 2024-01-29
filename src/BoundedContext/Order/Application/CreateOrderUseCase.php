<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Application;

use Src\BoundedContext\Order\Domain\Contracts\OrderRepositoryContract;
use Src\BoundedContext\Order\Domain\Order;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderCpf;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderEmail;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderName;

final class CreateOrderUseCase
{
    private OrderRepositoryContract $repository;

    public function __construct(OrderRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?string $orderName,
        ?string $orderEmail,
        ?string $orderCpf,
    ): Order
    {
        $id     = new OrderId(null);
        $name   = new OrderName($orderName);
        $email  = new OrderEmail($orderEmail);
        $cpf    = new OrderCpf($orderCpf);

        $order = Order::create($id, $name, $email, $cpf);

        return $this->repository->save($order);
    }
}
