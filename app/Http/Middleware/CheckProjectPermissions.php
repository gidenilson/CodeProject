<?php

namespace CodeProject\Http\Middleware;

use Closure;
use CodeProject\Services\ProjectService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class CheckProjectPermissions
{

    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! $this->service->hasPermissions($request->id, Authorizer::getResourceOwnerId())){
            return ["error" => "Access forbidden"];
        }
        return $next($request);
    }
}
