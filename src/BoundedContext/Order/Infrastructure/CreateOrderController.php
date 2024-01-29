<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Order\Application\CreateOrderUseCase;
use Src\BoundedContext\Order\Infrastructure\Eloquent\EloquentOrderRepository;

final class CreateOrderController
{
    private EloquentOrderRepository $repository;

    public function __construct(EloquentOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $orderName   = $request->input('name') ?? null;
        $orderEmail  = $request->input('email') ?? null;
        $orderCpf    = $request->input('cpf') ?? null;

        $createOrderUseCase = new CreateOrderUseCase($this->repository);

        return $createOrderUseCase->__invoke(
            $orderName,
            $orderEmail,
            $orderCpf
        );
    }
}
