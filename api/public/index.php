<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

require '../vendor/autoload.php';
require '../src/config/config.php';
require '../src/config/db.php';
require '../src/config/constants.php';

require '../src/model/basica/empresa.php';
require '../src/model/basica/profissional.php';
require '../src/model/basica/vaga.php';
require '../src/model/basica/cargo.php';
require '../src/model/basica/curso.php';
require '../src/model/basica/idioma.php';
require '../src/model/basica/competenciatecnica.php';
require '../src/model/basica/competenciacomport.php';
require '../src/model/basica/perguntaperfilcomp.php';
require '../src/model/basica/alternativaperfilcomp.php';
require '../src/model/basica/profissionalrespota.php';



require '../src/model/dados/daocompetenciatecnica.php';
require '../src/model/dados/daocompetenciacomport.php';
require '../src/model/dados/DaoPerguntaperfilcomp.php';
require '../src/model/dados/Daoalternativaperfilcomp.php';
require '../src/model/dados/DAOProfissionalresposta.php';




require '../src/model/dados/conversordeobjetos.php';

require '../src/controller/negocio/rnempresa.php';
require '../src/controller/negocio/rnvaga.php';
require '../src/controller/negocio/rnprofissional.php';
require '../src/controller/negocio/rncargo.php';
require '../src/controller/negocio/rncurso.php';
require '../src/controller/negocio/rnidioma.php';
require '../src/controller/negocio/rncompetenciatecnica.php';
require '../src/controller/negocio/rncompetenciacomport.php';
require '../src/controller/negocio/RNPerguntaperfilcomp.php';
require '../src/controller/negocio/RNalternativaperfilcomp.php';
require '../src/controller/negocio/RNprofissionalresposta.php';




$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

require '../src/view/routes/servicos.php';

$app->run();