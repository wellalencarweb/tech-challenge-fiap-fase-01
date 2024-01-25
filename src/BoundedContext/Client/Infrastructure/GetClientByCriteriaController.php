<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Client\Application\GetClientByCriteriaUseCase;
use Src\BoundedContext\Client\Infrastructure\Repositories\EloquentClientRepository;

final class GetClientByCriteriaController
{
    private $repository;

    public function __construct(EloquentClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $userName  = $request->input('name');
        $userEmail = $request->input('email');

        $getClientByCriteriaUseCase = new GetClientByCriteriaUseCase($this->repository);
        $user                     = $getClientByCriteriaUseCase->__invoke($userName, $userEmail);

        return $user;
    }
}
