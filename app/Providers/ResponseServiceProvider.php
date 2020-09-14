<?php

namespace App\Providers;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @param ResponseFactory $factory
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('success', function ($message = '', $data = null, $code=200) use ($factory) {
            $format = [
                'code' => $code,
                'status' => 'success',
                'message' => $message,
                'data' => $data,
            ];

            return $factory->json($format, $code);
        });

        $factory->macro('error', function (string $message = '', $errors = [], $code=400) use ($factory){
            $format = [
                'code' => $code,
                'status' => 'error',
                'message' => $message,
                'errors' => $errors,
            ];

            return $factory->json($format, $code);
        });
    }
}
