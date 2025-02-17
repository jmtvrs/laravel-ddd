<?php

declare(strict_types=1);

namespace Web\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final readonly class LoggingContextMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        Log::shareContext(array_filter([
            'hostname' => gethostname(),
            'ip' => request()?->ip(),
            'ua' => request()?->userAgent(),
            'trace_id' => $request->header('X-Trace-ID') ?? Str::uuid()->toString(),
        ]));

        //        Context::add('hostname', gethostname());
        //        Context::add('trace_id', $traceID);

        return $next($request);
    }
}
