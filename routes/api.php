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
            $ignore_routes = [
                'product.photo.stream',
                'equipment.photo.stream',
            ];

            if(
                Str::startsWith($route->uri, 'api/v1/')
                && !in_array($route->getName(), $ignore_routes)
            ) {
                $formattedUri = preg_replace('/\{(\w+)\}/', ':$1', $route->uri);

                $endpoints[] = [
                    'api_url' => url($formattedUri),
                    'method' => $route->methods[0],
                ];
            }
        }

        return response()->json([
            'endpoints' => $endpoints,
        ]);
    });

    Route::get('/settings', [SettingController::class, 'index']);
});