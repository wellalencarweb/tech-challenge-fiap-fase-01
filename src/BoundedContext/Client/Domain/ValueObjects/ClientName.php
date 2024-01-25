<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Domain\ValueObjects;

final class ClientName
{
    private $value;

    public function __construct(string $name)
    {
        $this->value = $name;
    }

    public function value(): string
    {
        return $this->value;
    }
}
