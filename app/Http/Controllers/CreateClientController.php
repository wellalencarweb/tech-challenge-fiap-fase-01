<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateClientController extends Controller
{
    /**
     * @var \Src\BoundedContext\Client\Infrastructure\CreateClientController
     */
    private $createClientController;

    public function __construct(\Src\BoundedContext\Client\Infrastructure\CreateClientController $createClientController)
    {
        $this->createClientController = $createClientController;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $newClient = new ClientResource($this->createClientController->__invoke($request));

        return response($newClient, 201);
    }
}
