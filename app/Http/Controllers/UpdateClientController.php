<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;

class UpdateClientController extends Controller
{
    /**
     * @var \Src\BoundedContext\Client\Infrastructure\UpdateClientController
     */
    private $updateClientController;

    public function __construct(\Src\BoundedContext\Client\Infrastructure\UpdateClientController $updateClientController)
    {
        $this->updateClientController = $updateClientController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $updatedClient = new ClientResource($this->updateClientController->__invoke($request));

        return response($updatedClient, 200);
    }
}
