<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class ResponseType
{

    /**
     * Check header for "response-type" (xml|json)
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->hasHeader('response-type') && $request->header('response-type') == 'xml'){
            Config::set('response-type','xml');
        }else{
            Config::set('response-type','json');
        }

        return $next($request);
    }
}
