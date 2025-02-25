<?php

use App\Http\Controllers\Api\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return [
        'php' => PHP_VERSION,
        'laravel' => app()->version()
    ];
});

Route::prefix('v1')->group(function () {
    Route::get('/', function () {
        $endpoints = [];

        foreach(Route::getRoutes() as $route) {
            if(
                Str::startsWith($route->uri, 'api/v1/')
                && !Str::endsWith($route->getName(), '.photo.stream')
            ) {
                $formattedUri = preg_replace('/\{(\w+)\}/', ':$1', $route->uri);

                $endpoints[] = [
                    'method' => $route->methods[0],
                    'api_route' => url($formattedUri),
                ];
            }
        }

        return response()->json([
            'endpoints' => $endpoints,
        ]);
    });

    Route::get('/settings', [SettingController::class, 'index']);
});