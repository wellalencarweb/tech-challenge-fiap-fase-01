<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\GetProductUseCase;
use Src\BoundedContext\Product\Application\UpdateProductUseCase;
use Src\BoundedContext\Product\Infrastructure\Eloquent\EloquentProductRepository;

final class UpdateProductController
{
    private EloquentProductRepository $repository;

    public function __construct(EloquentProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $productId = (int)$request->id;

        $getProductUseCase = new GetProductUseCase($this->repository);
        $product           = $getProductUseCase->__invoke($productId);

        $productName              = $request->input('name') ?? $product->name()->value();
        $productEmail             = $request->input('email') ?? $product->email()->value();
        $productCpf               = $request->input('cpf') ?? $product->cpf()->value();


        $updateProductUseCase = new UpdateProductUseCase($this->repository);
        $updateProductUseCase->__invoke(
            $productId,
            $productName,
            $productEmail,
            $productCpf
        );

        return $getProductUseCase->__invoke($productId);
    }
}
