<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Application;

use Src\BoundedContext\Order\Domain\Contracts\OrderRepositoryContract;
use Src\BoundedContext\Order\Domain\Order;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderCpf;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderEmail;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderName;

final class GetOrderByCriteriaUseCase
{
    private OrderRepositoryContract $repository;

    public function __construct(OrderRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?string $orderName,
        ?string $orderEmail,
        ?string $orderCpf
    ): array
    {
        $name   = new OrderName($orderName);
        $email  = new OrderEmail($orderEmail);
        $cpf    = new OrderCpf($orderCpf);

        return $this->repository->findByCriteria($name, $email, $cpf);
    }
}
