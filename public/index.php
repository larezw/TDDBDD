<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$app = AppFactory::create();


$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("
<html>
    <body>
        <h1>Bienvenido al Ahorcado</h1>
        <form action='/palabra' method='post'>
            <label>Palabra:</label><input name='palabra' type='text' /><br/>
            <input type='submit' value='Jugar' />
        </form>
    </body>
</html>
");
    return $response;
});

$app->post('/palabra', function(Request $request, Response $response, array $args){
    $params = $request->getParsedBody();
    if (empty($params['palabra']) && strlen($params['palabra'])<=2) {
        # error, entonces va de nuevo al home
        $response = $response->withStatus(302);
        $response = $response->withHeader("Location", '/');
        return $response;
    }

    $_SESSION['palabra'] = $params['palabra'];
    $response = $response->withStatus(302);
    $response = $response->withHeader("Location", '/jugar');
    return $response;
});

# esta controller va agarrar las URLS: /jugar/a ó /jugar/w
# donde args va a tener una key letra con el contenido despues de la segunda barra
# /jugar/CHACHARA => entonces args['letra'] == 'CHACHARA'
$app->get('/jugar/{letra}', function(Request $request, Response $response, array $args){
    if (strlen($args['letra']) == 1){
        $_SESSION['letras'][] = $args['letra'];
    }
    $response = $response->withStatus(302);
    $response = $response->withHeader("Location", '/jugar');
    return $response;
});




# nunca borrar esta linea, es la que hace que ande
$app->run();