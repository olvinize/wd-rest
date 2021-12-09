<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Models\EnglishTransformer;
use App\Models\LatvianTransformer;
use Illuminate\Http\Request;

$router->get('/', function (Request $request) use ($router) {
    $language = $request->get('lang');
    $number = (int)$request->get('n', -1);

    if ($number >= 0 && $number < 10000) {
        $transformers = [
            'eng' => EnglishTransformer::class,
            'lat' => LatvianTransformer::class
        ];

        $numberTransformer = is_string($transformers[$language]) ? new $transformers[$language]() : null;
        return $numberTransformer ? $numberTransformer->translate($number) : null;
    }
    return null;
});
