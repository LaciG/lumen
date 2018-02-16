<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/hello/world', function () use ($router){
    return "Hello World";
});

/* $router->get('/hello/{name}', function ($name) use ($router){
    return "Hello {$name}";
}); */

$router->get('/hello/{name}', ['middleware' => 'hello', function ($name) {
    return "Hello {$name}";
}]);

//2-21: Using the request object
$router->get('/request', function (Illuminate\Http\Request $request){
    return "Hello " . $request->get('name', 'stranger');
});

//2-23: Using the Illuminate Response Object
/* $router->get('/response', function (Illuminate\Http\Request $request){
    return (new Illuminate\Http\Response('Hello stranger', 200))->header('Content-Type', 'text/plain');
}); */

//2-24: Responding with JSON
/* $router->get('/response', function (Illuminate\Http\Request $request){
    if($request->wantsJson()){
        return response()->json(['greeting' => 'Hello Stranger']);
    }
    return (new Illuminate\Http\Response('Hello stranger', 200))->header('Content-Type', 'text/plain');
}); */

//2-26: Using the ResponseFactory
$router->get('/response', function (Illuminate\Http\Request $request){
    if ($request->wantsJson()) {
        return response()->json(['greeting' => 'Hello Stranger']);
    }
    return response()->make('Hello Stranger', 200, ['Content-Type' => 'text/plain']);
});

/* $router->get('/response', function (Illuminate\Http\Request $request){
    if ($request->wantsJson()) {
        return response()->json(['greeting' => 'Hello Stranger']);
    }
    return response()->json(['greeting' => 'Hello Stranger']);
    //return response()->make('Hello Stranger', 200, ['Content-Type' => 'text/plain']);
}); */