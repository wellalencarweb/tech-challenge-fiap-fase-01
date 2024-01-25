<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Application;

use DateTime;
use Src\BoundedContext\Client\Domain\Contracts\ClientRepositoryContract;
use Src\BoundedContext\Client\Domain\Client;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmailVerifiedDate;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientId;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientPassword;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientRememberToken;

final class UpdateClientUseCase
{
    private $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $userId,
        string $userName,
        string $userEmail,
        ?DateTime $userEmailVerifiedDate,
        string $userPassword,
        ?string $userRememberToken
    ): void
    {
        $id                = new ClientId($userId);
        $name              = new ClientName($userName);
        $email             = new ClientEmail($userEmail);
        $emailVerifiedDate = new ClientEmailVerifiedDate($userEmailVerifiedDate);
        $password          = new ClientPassword($userPassword);
        $rememberToken     = new ClientRememberToken($userRememberToken);

        $user = Client::create($name, $email, $emailVerifiedDate, $password, $rememberToken);

        $this->repository->update($id, $user);
    }
}
