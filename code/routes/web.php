<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Transformer;
use Illuminate\Http\Request;

$router->get('/', function (Request $request) {
    /** @var $this \Laravel\Lumen\Routing\Closure */
    try {
        $this->validate($request, Transformer::getValidationRules());

        $transformer = Transformer::create($request->get('lang'));
        //return response()->json($transformer->translate((int)$request->get('n')));
        return $transformer->translate((int)$request->get('n'));
    } catch (Exception $e) {

    }
    return null;
});
