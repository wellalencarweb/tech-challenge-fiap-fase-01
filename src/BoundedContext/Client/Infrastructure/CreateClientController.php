<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $userName              = $request->input('name');
        $userEmail             = $request->input('email');
        $userEmailVerifiedDate = null;
        $userPassword          = Hash::make($request->input('password'));
        $userRememberToken     = null;

        $createClientUseCase = new CreateClientUseCase($this->repository);
        $createClientUseCase->__invoke(
            $userName,
            $userEmail,
            $userEmailVerifiedDate,
            $userPassword,
            $userRememberToken
        );

        $getClientByCriteriaUseCase = new GetClientByCriteriaUseCase($this->repository);
        return $getClientByCriteriaUseCase->__invoke($userName, $userEmail);
    }
}
