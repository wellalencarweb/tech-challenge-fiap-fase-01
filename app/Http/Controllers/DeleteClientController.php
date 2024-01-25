<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteClientController extends Controller
{
    /**
     * @var \Src\BoundedContext\Client\Infrastructure\DeleteClientController
     */
    private $deleteClientController;

    public function __construct(\Src\BoundedContext\Client\Infrastructure\DeleteClientController $deleteClientController)
    {
        $this->deleteClientController = $deleteClientController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->deleteClientController->__invoke($request);

        return response([], 204);
    }
}
