<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Src\BoundedContext\Client\Infrastructure\UpdateClientController as UpdateClientControllerInfra;

class UpdateClientController extends Controller
{
    private UpdateClientControllerInfra $updateClientControllerInfra;

    public function __construct(UpdateClientControllerInfra $updateClientControllerInfra)
    {
        $this->updateClientControllerInfra = $updateClientControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $updatedClient = new ClientResource($this->updateClientControllerInfra->__invoke($request));

        return response($updatedClient, 200);
    }
}
