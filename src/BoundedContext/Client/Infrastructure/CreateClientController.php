<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Client\Application\CreateClientUseCase;
use Src\BoundedContext\Client\Application\GetClientByCriteriaUseCase;
use Src\BoundedContext\Client\Infrastructure\Repositories\EloquentClientRepository;

final class CreateClientController
{
    private $repository;

    public function __construct(EloquentClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $clientName   = $request->input('name');
        $clientEmail  = $request->input('email');
        $clientCpf    = $request->input('cpf');

        $createClientUseCase = new CreateClientUseCase($this->repository);
        $createClientUseCase->__invoke(
            $clientName,
            $clientEmail,
            $clientCpf
        );

        $getClientByCriteriaUseCase = new GetClientByCriteriaUseCase($this->repository);
        return $getClientByCriteriaUseCase->__invoke($clientName, $clientEmail, $clientCpf);
    }
}
