<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Domain;

use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmailVerifiedDate;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientPassword;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientRememberToken;

final class Client
{
    private $name;
    private $email;
    private $emailVerifiedDate;
    private $password;
    private $rememberToken;

    public function __construct(
        ClientName $name,
        ClientEmail $email,
        ClientEmailVerifiedDate $emailVerifiedDate,
        ClientPassword $password,
        ClientRememberToken $rememberToken
    )
    {
        $this->name              = $name;
        $this->email             = $email;
        $this->emailVerifiedDate = $emailVerifiedDate;
        $this->password          = $password;
        $this->rememberToken     = $rememberToken;
    }

    public function name(): ClientName
    {
        return $this->name;
    }

    public function email(): ClientEmail
    {
        return $this->email;
    }

    public function emailVerifiedDate(): ClientEmailVerifiedDate
    {
        return $this->emailVerifiedDate;
    }

    public function password(): ClientPassword
    {
        return $this->password;
    }

    public function rememberToken(): ClientRememberToken
    {
        return $this->rememberToken;
    }

    public static function create(
        ClientName $name,
        ClientEmail $email,
        ClientEmailVerifiedDate $emailVerifiedDate,
        ClientPassword $password,
        ClientRememberToken $rememberToken
    ): Client
    {
        $user = new self($name, $email, $emailVerifiedDate, $password, $rememberToken);

        return $user;
    }
}
