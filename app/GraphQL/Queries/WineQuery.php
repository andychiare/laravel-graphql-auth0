namespace App\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Wine;
use Auth0\SDK\JWTVerifier;

class WineQuery extends Query {

    protected $attributes = [
        'name'  => 'wine',
    ];

	public function authorize(array $args)
    {
		$verifier = new JWTVerifier([
    		'valid_audiences' => [env( 'AUTH0_AUDIENCE' )],
    		'authorized_iss' => [env( 'AUTH0_DOMAIN' )]
		]);

		$decoded = $verifier->verifyAndDecode($token);
    	return (boolean) $decoded;
    }

    public function type()
    {
        return GraphQL::type('Wine');
    }

    public function args()
    {
        return [
            'id'    => [
                'name' => 'id',
                'type' => Type::int(),
            	'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Wine::findOrFail($args['id']);
    }

}