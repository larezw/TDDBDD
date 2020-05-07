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
        $response = $response->withStatus(302);
        $response = $response->withHeader("Location", '/');
        return $response;
    }

    $_SESSION['palabra'] = $params['palabra'];
    $response = $response->withStatus(302);
    $response = $response->withHeader("Location", '/jugar');
    return $response;
});

$app->get('/jugar/{letra}', function(Request $request, Response $response, array $args){
    if (strlen($args['letra']) == 1){
        $_SESSION['letras'][] = $args['letra'];
    }
    $response = $response->withStatus(302);
    $response = $response->withHeader("Location", '/jugar');
    return $response;
});

$app->get('/jugar', function(Request $request, Response $response, array $args){

    if (empty($_SESSION['palabra'])) {
        $response = $response->withStatus(302);
        $response = $response->withHeader("Location", '/');
        return $response;
    }

    $links = array();
    for($i=65; $i<=90; $i++) {
        $letra = chr($i);
        $links[] = "<a class='letrasjugar' href='/jugar/$letra'>$letra</a>";
    }
    $linksPrint = implode(" | ", $links);
    $termino = '';

    $ahorcado = new \GlobalHitss\Ahorcado($_SESSION['palabra']);
    if (!empty($_SESSION['letras'])) {
        foreach($_SESSION['letras'] as $letra) {
            $ahorcado->jugar($letra);
        }
    }

    if ($ahorcado->termino()) {
        if ($ahorcado->gano()) {
            $termino = "Ganaste!";
        }
        if ($ahorcado->perdio()) {
            $termino = "Perdiste, la palabra era: " . $ahorcado->palabraOriginal();
        }
        $linksPrint = ""; // borramos los links para que no pueda jugar mas
        unset($_SESSION['palabra']);
        unset($_SESSION['letras']);
    }

    $response->getBody()->write("
<html>
    <body>
        <h1>Bienvenido al Ahorcado</h1>
        <h3>".$ahorcado->mostrar()."</h3>
        <hr/>$linksPrint
        $termino
        <hr/>
        <a href='/'>Volver al inicio</a>
    </body>
</html>
");

    return $response;
});

$app->run();