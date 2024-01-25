<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Application;

use Src\BoundedContext\Client\Domain\Contracts\ClientRepositoryContract;
use Src\BoundedContext\Client\Domain\Client;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;

final class GetClientByCriteriaUseCase
{
    private $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $userName, string $userEmail): ?Client
    {
        $name  = new ClientName($userName);
        $email = new ClientEmail($userEmail);

        $user = $this->repository->findByCriteria($name, $email);

        return $user;
    }
}
