<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\Http\Middleware\CheckClientCredentials as Middleware;

class CheckClientCredentials extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$scopes){
        $psr = (new DiactorosFactory)->createRequest($request);

        try {
            $psr = $this->server->validateAuthenticatedRequest($psr);
        } catch (OAuthServerException $e) {
            throw new AuthenticationException;
        }

        $this->validateScopes($psr, $scopes);

        $request->attributes->set('oauth_access_token_id', $psr->getAttribute('oauth_access_token_id'));
        $request->attributes->set('oauth_client_id', $psr->getAttribute('oauth_client_id'));
        $request->attributes->set('oauth_user_id', $psr->getAttribute('oauth_user_id'));
        $request->attributes->set('oauth_scopes', $psr->getAttribute('oauth_scopes'));

        return $next($request);
    }
}
