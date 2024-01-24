<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateUserController extends Controller
{
    /**
     * @var \Src\BoundedContext\User\Infrastructure\CreateUserController
     */
    private $createUserController;

    public function __construct(\Src\BoundedContext\User\Infrastructure\CreateUserController $createUserController)
    {
        $this->createUserController = $createUserController;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $newUser = new UserResource($this->createUserController->__invoke($request));

        return response($newUser, 201);
    }

    public function teste()
    {
        return 'ok';
    }
}
