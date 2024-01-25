<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Application;

use Src\BoundedContext\Client\Domain\Contracts\ClientRepositoryContract;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientId;

final class DeleteClientUseCase
{
    private $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $userId): void
    {
        $id = new ClientId($userId);

        $this->repository->delete($id);
    }
}
