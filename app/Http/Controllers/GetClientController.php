<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;

class GetClientController extends Controller
{
    /**
     * @var \Src\BoundedContext\Client\Infrastructure\GetClientController
     */
    private $getClientController;

    public function __construct(\Src\BoundedContext\Client\Infrastructure\GetClientController $getClientController)
    {
        $this->getClientController = $getClientController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = new ClientResource($this->getClientController->__invoke($request));

        return response($user, 200);
    }
}
