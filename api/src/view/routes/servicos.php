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

    $vaga->setNrQtdVaga($request->getParam('nr_qtd_vaga'));
    $vaga->setDsObservacao($request->getParam('ds_observacao'));
    $vaga->setDtValidade($request->getParam('dt_validade'));
    $vaga->setTpContratacao($request->getParam('tp_contratacao'));
    $vaga->setNrLongitude($request->getParam('nr_longitude'));
    $vaga->setNrLatitude($request->getParam('nr_latitude'));
    $vaga->setDsBeneficios($request->getParam('ds_beneficios'));
    $vaga->setDsHorarioExpediente($request->getParam('ds_horario_expediente'));
    $vaga->setDtCriacao($request->getParam('dt_criacao'));
    $vaga->setDsTitulo($request->getParam('ds_titulo'));
    $vaga->setVlSalario($request->getParam('vl_salario'));
	$cargo->setCdCargo($request->getParam('cd_cargo'));
	$vaga->setCargo($cargo);
	$empresa->setCdEmpresa($request->getParam('cd_empresa'));
	$vaga->setEmpresa($empresa);

    //Pegando a lista de idiomas no JSON e colocando na lista de idiomas na vaga
    $idiomas = json_decode($request->getParam('idiomas'), true);

    if ($idiomas != NULL){
        foreach ($idiomas as $key => $value) {
            $idioma = new Idioma();
            foreach ($value as $key => $value) {      
                if($key == 'cd_idioma')
                    $idioma->setCdIdioma($value);
                if($key == 'nr_nivel')
                    $idioma->setNrNivel($value);           
            }
            $vaga->setIdiomas($idioma); 
        }
    }

    //Pegando a lista de habilidades no JSON e colocando na lista de habilidades na vaga
    $habilidades = json_decode($request->getParam('habilidades'), true);

    if ($habilidades != NULL){
        foreach ($habilidades as $key => $value) {
            $habilidade = new Habilidade();
            foreach ($value as $key => $value) {      
                if($key == 'cd_habilidade')
                    $habilidade->setCdHabilidade($value);           
            }
            $vaga->setHabilidades($habilidade); 
        }
    }

    //Pegando a lista de cursos no JSON e colocando na lista de cursos na vaga
    $cursos = json_decode($request->getParam('cursos'), true);

    if ($cursos != NULL){
        foreach ($cursos as $key => $value) {
            $curso = new Curso();
            foreach ($value as $key => $value) {      
                if($key == 'cd_curso')
                    $curso->setCdCurso($value);           
            }
            $vaga->setCursos($curso); 
        }
    }

	try{
        $rnvaga = new RNVaga();
        $response->write(json_encode($rnvaga->publicar($vaga)));
         
    } catch(PDOException $e){
        echo json_encode(array('erro' => $e->getMessage()));
    }
});

/**
 * Curtir Vaga
 */
$app->post('/api/vaga/curtirVaga', function(Request $request, Response $response){
    $vagaProfssional = new VagaProfissional();
    $vaga = new Vaga();
    $profissional = new Profissional();

    $vaga->setCdVaga($request->getParsedBody()['cd_vaga']);
    $profissional->setCdProfissional($request->getParsedBody()['cd_profissional']);

    $vagaProfssional->setTpAcao($request->getParsedBody()['tp_acao']);
    $vagaProfssional->setVaga($vaga);
    $vagaProfssional->setProfissional($profissional);

    try{
        $rnvagapro = new RNVagaProfissional();
        $result = $rnvagapro->curtirVaga($vagaProfssional);
        echo json_encode($result);
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
