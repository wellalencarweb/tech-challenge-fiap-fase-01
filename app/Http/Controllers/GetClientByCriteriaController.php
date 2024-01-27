<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Src\BoundedContext\Client\Infrastructure\GetClientByCriteriaController as GetClientByCriteriaControllerInfra;

class GetClientByCriteriaController extends Controller
{

    private GetClientByCriteriaControllerInfra $getClientByCriteriaController;

    public function __construct(GetClientByCriteriaControllerInfra $getClientByCriteriaController)
    {
        $this->getClientByCriteriaController = $getClientByCriteriaController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $clients = new ClientResource($this->getClientByCriteriaController->__invoke($request));

        return response($clients, 200);
    }
}
