<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Client\Application\GetClientUseCase;
use Src\BoundedContext\Client\Application\UpdateClientUseCase;
use Src\BoundedContext\Client\Infrastructure\Eloquent\EloquentClientRepository;

final class UpdateClientController
{
    private $repository;

    public function __construct(EloquentClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $userId = (int)$request->id;

        $getClientUseCase = new GetClientUseCase($this->repository);
        $user           = $getClientUseCase->__invoke($userId);

        $userName              = $request->input('name') ?? $user->name()->value();
        $userEmail             = $request->input('email') ?? $user->email()->value();
        $userEmailVerifiedDate = $user->emailVerifiedDate()->value();
        $userPassword          = $user->password()->value();
        $userRememberToken     = $user->rememberToken()->value();

        $updateClientUseCase = new UpdateClientUseCase($this->repository);
        $updateClientUseCase->__invoke(
            $userId,
            $userName,
            $userEmail,
            $userEmailVerifiedDate,
            $userPassword,
            $userRememberToken
        );

        $updatedClient = $getClientUseCase->__invoke($userId);

        return $updatedClient;
    }
}
