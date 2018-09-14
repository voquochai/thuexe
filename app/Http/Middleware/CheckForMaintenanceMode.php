<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForMaintenanceMode {
    
    protected $request;
    protected $app;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle($request, Closure $next)
    {
        if ( config('settings.maintenance') == 'on' ) {
            return abort(503);
        }

        return $next($request);
    }

}