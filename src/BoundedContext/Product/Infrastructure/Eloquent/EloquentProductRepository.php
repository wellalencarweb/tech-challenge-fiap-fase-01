<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure\Eloquent;

use Src\BoundedContext\Product\Infrastructure\Eloquent\ProductModel as EloquentProductModel;
use Src\BoundedContext\Product\Domain\Contracts\ProductRepositoryContract;
use Src\BoundedContext\Product\Domain\Product;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductCpf;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductEmail;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;


final class EloquentProductRepository implements ProductRepositoryContract
{
    private EloquentProductModel $eloquentProductModel;

    public function __construct()
    {
        $this->eloquentProductModel = new EloquentProductModel;
    }

    public function find(ProductId $id): ?Product
    {
        $product = $this->eloquentProductModel->findOrFail($id->value());
        return $this->createDomainProductModel($product);
    }


    public function findByCriteria(?ProductName $productName, ?ProductEmail $productEmail, ?ProductCpf $productCpf): array
    {
        $products = [];

        $search = $this->eloquentProductModel->newQuery();

        if (!is_null($productName->value())) {
            $search->where('name', $productName->value());
        }

        if (!is_null($productEmail->value())) {
            $search->where('email', $productEmail->value());
        }

        if (!is_null($productCpf->value())) {
            $search->where('cpf', $productCpf->value());
        }

        $productsList = $search->get();

        foreach ($productsList as $product){
            $products[] = $this->createDomainProductModel($product);
        }

        return $products;
    }

    public function save(Product $product): Product
    {
        $newProduct = $this->eloquentProductModel;

        $data = [
            'name' => $product->name()->value(),
            'email' => $product->email()->value(),
            'cpf' => $product->cpf()->value(),
        ];

        $product = $newProduct->create($data);

        return $this->createDomainProductModel($product);
    }

    public function update(Product $product): void
    {
        $productToUpdate = $this->eloquentProductModel;

        $data = [
            'name'  => $product->name()->value(),
            'email' => $product->email()->value(),
            'cpf'   => $product->cpf()->value(),
        ];

        $productToUpdate
            ->findOrFail($product->id()->value())
            ->update($data);
    }

    public function delete(ProductId $id): void
    {
        $this->eloquentProductModel
            ->findOrFail($id->value())
            ->delete();
    }

    private function createDomainProductModel(ProductModel $product): Product
    {
        return new Product(
            new ProductId($product->id),
            new ProductName($product->name),
            new ProductEmail($product->email),
            new ProductCpf($product->cpf)
        );
    }
}
