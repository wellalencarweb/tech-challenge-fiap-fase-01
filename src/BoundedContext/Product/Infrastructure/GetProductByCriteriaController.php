<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\GetProductByCriteriaUseCase;
use Src\BoundedContext\Product\Infrastructure\Eloquent\EloquentProductRepository;

final class GetProductByCriteriaController
{
    private EloquentProductRepository $repository;

    public function __construct(EloquentProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $productName  = $request->input('name') ?? null;
        $productEmail = $request->input('email') ?? null;
        $productCpf   = $request->input('cpf') ?? null;

        $getProductByCriteriaUseCase = new GetProductByCriteriaUseCase($this->repository);
        return $getProductByCriteriaUseCase->__invoke($productName, $productEmail, $productCpf);
    }
}
