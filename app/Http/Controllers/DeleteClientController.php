<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\BoundedContext\Client\Infrastructure\DeleteClientController as DeleteClientControllerInfra;

class DeleteClientController extends Controller
{
    private DeleteClientControllerInfra $deleteClientControllerInfra;

    public function __construct(DeleteClientControllerInfra $deleteClientControllerInfra)
    {
        $this->deleteClientControllerInfra = $deleteClientControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->deleteClientControllerInfra->__invoke($request);

        return response([], 204);
    }
}
