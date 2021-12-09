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
use NumberToWords\NumberToWords;

$router->get('/', function (\Illuminate\Http\Request $request) use ($router) {
    $language = $request->get('lang');
    $number = (int)$request->get('n', -1);

    if ($number >= 0 && $number < 10000) {
        $numberTransformer = null;
        switch ($language) {
            case 'eng':
                $numberTransformer = new EnglishTransformer();
                break;
            case 'lat':
                $numberTransformer = new LatvianTransformer();
                break;
        }
        return $numberTransformer ? $numberTransformer->translate($number) : null;
    }
    return null;
});
