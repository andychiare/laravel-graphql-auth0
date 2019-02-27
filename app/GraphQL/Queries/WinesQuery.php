<?php
namespace App\GraphQL\Queries;

use GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL\Type\Definition\Type;
use App\Wine;
use Auth0\SDK\JWTVerifier;

class WinesQuery extends Query {

    protected $attributes = [
        'name'  => 'wines',
    ];

	public function authorize(array $args)
    {
    	$isAuthorized = true;
    
    	if (!empty(env( 'AUTH0_AUDIENCE' )) && !empty(env( 'AUTH0_DOMAIN' ))) {
			$verifier = new JWTVerifier([
    			'valid_audiences' => [env( 'AUTH0_AUDIENCE' )],
    			'authorized_iss' => [env( 'AUTH0_DOMAIN' )],
            	'client_secret' => [env( 'AUTH0_CLIENT_SECRET' )]
			]);

			$decoded = $verifier->verifyAndDecode($token);
        	$isAuthorized = (boolean) $decoded;
        }
    
    	return $isAuthorized;
    }

    public function type()
    {
        return Type::listOf(GraphQL::type('Wine'));
    }

    public function resolve($root, $args)
    {
      return Wine::all();
    }
}