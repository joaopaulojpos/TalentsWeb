<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

//-------- Empresa

$app->get('/api/empresas', function(Request $request, Response $response){
    $sql = "SELECT * FROM empresa";

    try{
        $db = new db();
        
        $db = $db->getInstance();

        $stmt = $db->query($sql);
        $empresa = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($empresa);
    } catch(Exception $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});

$app->post('/api/empresa/login', function(Request $request, Response $response){
    
    $login = $request->getParam('login');
    $senha = $request->getParam('senha');    

    try{
        $rnempresa = new RNEmpresa();        
        $rnempresa = $rnempresa->logar($login, $senha);
        echo json_encode($rnempresa);   

    } catch(Exception $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});

$app->post('/api/empresa/salvar', function(Request $request, Response $response){

    $cnpj = $request->getParam('cnpj');
    $razao_social = $request->getParam('razaosocial');
    $nome_fantasia = $request->getParam('nomefantasia');
    $porte = $request->getParam('porte');
    $area_atuacao = $request->getParam('areaatuacao');
    $responsavel = $request->getParam('responsavel');
    $telefone = $request->getParam('telefone');
    $site = $request->getParam('site');
    $email = $request->getParam('email');
    $senha = $request->getParam('senha'); 
    $codigo = $request->getParam('codigo');   

    try{
        $empresa = new Empresa();
        if ($codigo != null){
            $empresa->setCdEmpresa($codigo); 
            /*$rnempresa = new RNEmpresa(); 
            $rnempresa = $rnempresa->pesquisar($empresa);
            if ($rnempresa == null){
               echo json_encode(array('erro' => 'Código da empresa não existe!')); 
            }*/
        }
        $empresa->setNrCnpj($cnpj);
        $empresa->setDsRazaoSocial($razao_social);
        $empresa->setDsNomeFantasia($nome_fantasia);
        $empresa->setNrPorte($porte);
        $empresa->setDsAreaAtuacao($area_atuacao);
        $empresa->setDsResponsavelCadastro($responsavel);   
        $empresa->setDsSite($site);
        $empresa->setDsTelefone($telefone);
        $empresa->setDsEmail($email);
        $empresa->setDsSenha($senha); 

        $rnempresa = new RNEmpresa(); 
        $rnempresa = $rnempresa->salvar($empresa);
        echo json_encode($rnempresa); 

    } catch(Exception $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});

$app->get('/api/empresa/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    try{
        $rnempresa = new RNEmpresa();        
        $empresa = new Empresa();
        $empresa->setCdEmpresa($id);
        $rnempresa = $rnempresa->pesquisar($empresa);
        echo json_encode($rnempresa);   

    } catch(Exception $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});

//------- Profissional

$app->get('/api/profissionais', function(Request $request, Response $response){
    $sql = "SELECT * FROM profissional";

    try{
        $db = new db();
        
        $db = $db->getInstance();

        $stmt = $db->query($sql);
        $profissional = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($profissional);
    } catch(PDOException $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});
$app->get('/api/profissional/login', function(Request $request, Response $response){
    
    $login = $request->getParam('login');
    $senha = $request->getParam('senha');    

    try{
        $rnprofissional = new RNProfissional();        
        $rnprofissional = $rnprofissional->logar($login, $senha);
        echo json_encode($rnprofissional);

    } catch(PDOException $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});

//----- Vaga

/**
* Visualizar vagas
*/
$app->get('/api/vagas', function(Request $request, Response $response){
    try{
        $vaga = new Vaga();
        $rnvaga = new RNVaga();        
        $rnvaga = $rnvaga->pesquisar($vaga);
        echo json_encode($rnvaga);  
    } catch(Exception $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});



/**
 * Cadastro da vaga
 */
$app->post('/api/vaga/publicar', function(Request $request, Response $response){

    $vaga = new Vaga();
	$cargo = new Cargo();
	$empresa = new Empresa();

    $vaga->setCdVaga($request->getParsedBody()['cd_vaga']);
    $vaga->setNrQtdVaga($request->getParsedBody()['nr_qtd_vaga']);
    $vaga->setDsObservacao($request->getParsedBody()['ds_observacao']);
    $vaga->setDtValidade($request->getParsedBody()['dt_validade']);
    $vaga->setTpContratacao($request->getParsedBody()['tp_contratacao']);
    $vaga->setNrLongitude($request->getParsedBody()['nr_longitude']);
    $vaga->setNrLatitude($request->getParsedBody()['nr_latitude']);
    $vaga->setDsBeneficios($request->getParsedBody()['ds_beneficios']);
    $vaga->setDsHorarioExpediente($request->getParsedBody()['ds_horario_expediente']);
    $vaga->setDtCriacao($request->getParsedBody()['dt_criacao']);
    $vaga->setDsTitulo($request->getParsedBody()['ds_titulo']);
    $vaga->setVlSalario($request->getParsedBody()['vl_salario']);
	$cargo->setCdCargo($request->getParsedBody()['cd_cargo']);
	$vaga->setCargo($cargo);
	$empresa->setCdEmpresa($request->getParsedBody()['cd_empresa']);
	$vaga->setEmpresa($empresa);
    try{
        $rnvaga = new RNVaga();
        $rnvaga->publicar($vaga);
    } catch(PDOException $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});



//------ cargo

$app->get('/api/cargos', function(Request $request, Response $response){
    try{
        $cargo = new Cargo();
        $rncargo = new RNCargo();        
        $rncargo = $rncargo->pesquisar($cargo);
        echo json_encode($rncargo);  
    } catch(Exception $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});

//------ curso

$app->get('/api/cursos', function(Request $request, Response $response){
    try{
        $curso = new Curso();
        $rncurso = new RNCurso();        
        $rncurso = $rncurso->pesquisar($curso);
        echo json_encode($rncurso);  
    } catch(Exception $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});

//------ idioma

$app->get('/api/idiomas', function(Request $request, Response $response){
    try{
        $idioma = new Idioma();
        $rnidioma = new RNIdioma();        
        $rnidioma = $rnidioma->pesquisar($idioma);
        echo json_encode($rnidioma);  
    } catch(Exception $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});

//------ habilidade

$app->get('/api/habilidades', function(Request $request, Response $response){
    try{
        $habilidade = new Habilidade();
        $rnhabilidade = new RNHabilidade();        
        $rnhabilidade = $rnhabilidade->pesquisar($habilidade);
        echo json_encode($rnhabilidade);  
    } catch(Exception $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});



?>
