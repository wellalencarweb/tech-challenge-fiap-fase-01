<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Src\BoundedContext\Client\Infrastructure\GetClientController as GetClientControllerInfra;

class GetClientController extends Controller
{

    private GetClientControllerInfra $getClientControllerInfra;

    public function __construct(GetClientControllerInfra $getClientControllerInfra)
    {
        $this->getClientControllerInfra = $getClientControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $client = new ClientResource($this->getClientControllerInfra->__invoke($request));

        return response($client, 200);
    }
}
