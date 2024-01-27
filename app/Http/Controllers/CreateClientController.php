<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Client\Infrastructure\CreateClientController as CreateClientControllerInfra;

class CreateClientController extends Controller
{
    /**
     * @var \Src\BoundedContext\Client\Infrastructure\CreateClientController
     */
    private CreateClientControllerInfra $createClientControllerInfra;

    public function __construct(CreateClientControllerInfra $createClientControllerInfra)
    {
        $this->createClientControllerInfra = $createClientControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $newClient = new ClientResource($this->createClientControllerInfra->__invoke($request));

        return response($newClient, 201);
    }
}
