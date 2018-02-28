<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';
require '../src/controller/negocio/RNEmpresa.php';
require '../src/model/basica/Empresa.php';
require '../src/controller/negocio/RNProfissional.php';


$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
require '../src/view/routes/servicos.php';

$app->run();