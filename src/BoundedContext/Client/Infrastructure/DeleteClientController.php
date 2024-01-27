<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Client\Application\DeleteClientUseCase;
use Src\BoundedContext\Client\Infrastructure\Eloquent\EloquentClientRepository;

final class DeleteClientController
{
    private EloquentClientRepository $repository;

    public function __construct(EloquentClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $clientId = (int)$request->id;

        $deleteClientUseCase = new DeleteClientUseCase($this->repository);
        $deleteClientUseCase->__invoke($clientId);
    }
}
