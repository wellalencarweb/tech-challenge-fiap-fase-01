<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain;

use JetBrains\PhpStorm\Pure;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductCpf;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductEmail;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;


final class Product
{
    public function __construct(
        private ProductId $id,
        private ProductName $name,
        private ProductEmail $email,
        private ProductCpf $cpf,

    )
    {
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function email(): ProductEmail
    {
        return $this->email;
    }

    public function cpf(): ProductCpf
    {
        return $this->cpf;
    }

    #[Pure]
    public static function create(
        ProductId $id,
        ProductName $name,
        ProductEmail $email,
        ProductCpf $cpf
    ): Product
    {
        return new self($id, $name, $email, $cpf);
    }
}
