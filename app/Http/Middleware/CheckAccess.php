<?php

namespace App\Http\Middleware;

use Closure;
use Auth0\SDK\JWTVerifier;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if (!empty(env( 'AUTH0_AUDIENCE' )) && !empty(env( 'AUTH0_DOMAIN' ))) {
			$verifier = new JWTVerifier([
    			'valid_audiences' => [env( 'AUTH0_AUDIENCE' )],
    			'authorized_iss' => [env( 'AUTH0_DOMAIN' )],
            	'client_secret' => env( 'AUTH0_CLIENT_SECRET' ),
            	'supported_algs' => ['RS256']
			]);

        	$token = $request-> bearerToken();
        	$token = ($token) ? $token : $request-> header('token');

			$decodedToken = $verifier->verifyAndDecode($token);

        	if (!$decodedToken) {
            	abort(403, 'Access denied');
            }
        }
        return $next($request);
    }
}
