<?php

declare(strict_types=1);

namespace Web\Controllers;

final readonly class WelcomeController
{
    public function __invoke()
    {
        return response()->json([
            'service' => config('app.name'),
            'release' => config('app.build'),
            'version' => config('app.version'),
            'env' => config('app.env'),
        ]);
    }
}
