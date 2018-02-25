<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';
require '../src/controller/negocio/RNEmpresa.php';


$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

/* Chamadas API 
delete: http://slimapp/api/usuario/delete/2
get: http://slimapp/api/usuarios
get: http://slimapp/api/usuario/3
post: http://slimapp/api/usuario/add
get: http://slimapp/api/vagas
*/
require '../src/view/routes/servicos.php';

$app->run();