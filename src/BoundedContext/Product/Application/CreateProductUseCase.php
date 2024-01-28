<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Application;

use Src\BoundedContext\Product\Domain\Contracts\ProductRepositoryContract;
use Src\BoundedContext\Product\Domain\Product;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductCpf;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductEmail;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;

final class CreateProductUseCase
{
    private ProductRepositoryContract $repository;

    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?string $productName,
        ?string $productEmail,
        ?string $productCpf,
    ): Product
    {
        $id     = new ProductId(null);
        $name   = new ProductName($productName);
        $email  = new ProductEmail($productEmail);
        $cpf    = new ProductCpf($productCpf);

        $product = Product::create($id, $name, $email, $cpf);

        return $this->repository->save($product);
    }
}
