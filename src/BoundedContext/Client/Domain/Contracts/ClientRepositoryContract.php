<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Domain\Contracts;

use Src\BoundedContext\Client\Domain\Client;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmailVerifiedDate;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientId;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;

interface ClientRepositoryContract
{
    public function find(ClientId $id): ?Client;

    public function findByCriteria(ClientName $userName, ClientEmail $userEmail): ?Client;

    public function save(Client $user): void;

    public function update(ClientId $userId, Client $user): void;

    public function delete(ClientId $id): void;
}
