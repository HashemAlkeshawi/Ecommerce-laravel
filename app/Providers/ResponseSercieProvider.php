<?php

namespace App\Providers;

use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class ResponseSercieProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('sendWithMessage', function ($data, $message, $status_code = 200) {
            return response()->json([
                'message' => $message,
                'data' => $data
            ], $status_code);
        });


        Response::macro('send', function ($data, $status_code = 200) {
            return response()->json([
                'data' => $data
            ], $status_code);
        });
    }
}
