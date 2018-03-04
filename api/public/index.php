<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

require '../vendor/autoload.php';
require '../src/config/config.php';
require '../src/config/db.php';
require '../src/config/constants.php';
require '../src/controller/negocio/RNEmpresa.php';
require '../src/model/basica/Empresa.php';
require '../src/controller/negocio/RNProfissional.php';
require '../src/model/basica/vaga.php';
require '../src/model/basica/cargo.php';
require '../src/model/dados/DAOVaga.php';
require '../src/controller/negocio/RNVaga.php';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

require '../src/view/routes/servicos.php';

$app->run();