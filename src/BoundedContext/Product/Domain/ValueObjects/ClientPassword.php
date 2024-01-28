<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\ValueObjects;

final class ProductPassword
{
    private $value;

    public function __construct(string $password)
    {
        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }
}
