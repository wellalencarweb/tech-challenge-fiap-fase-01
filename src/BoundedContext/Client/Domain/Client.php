<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Domain;

use JetBrains\PhpStorm\Pure;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;


final class Client
{
    private ClientName $name;
    private ClientEmail $email;


    public function __construct(
        ClientName $name,
        ClientEmail $email,
    )
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function name(): ClientName
    {
        return $this->name;
    }

    public function email(): ClientEmail
    {
        return $this->email;
    }

    #[Pure]
    public static function create(
        ClientName $name,
        ClientEmail $email,
    ): Client
    {
        return new self($name, $email);
    }
}
