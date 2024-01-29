<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain;

use JetBrains\PhpStorm\Pure;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderCpf;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderEmail;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderName;


final class Order
{
    public function __construct(
        private OrderId $id,
        private OrderName $name,
        private OrderEmail $email,
        private OrderCpf $cpf,

    )
    {
    }

    public function id(): OrderId
    {
        return $this->id;
    }

    public function name(): OrderName
    {
        return $this->name;
    }

    public function email(): OrderEmail
    {
        return $this->email;
    }

    public function cpf(): OrderCpf
    {
        return $this->cpf;
    }

    #[Pure]
    public static function create(
        OrderId $id,
        OrderName $name,
        OrderEmail $email,
        OrderCpf $cpf
    ): Order
    {
        return new self($id, $name, $email, $cpf);
    }
}
