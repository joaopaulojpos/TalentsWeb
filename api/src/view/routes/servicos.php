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
    try{
        /*$sql = "SELECT * FROM empresa";
    
        $db = db::getInstance();

        $stmt = $db->query($sql);
        $empresa = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;*/

        $rnempresa = new RNEmpresa();
        $empresa = new Empresa();
        $rnempresa = $rnempresa->pesquisar($empresa);
        $response->write(json_encode($rnempresa));
    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->post('/api/empresa/login', function(Request $request, Response $response){
    
    try{ 
        $login = $request->getParam('login');
        $senha = $request->getParam('senha');    

        $rnempresa = new RNEmpresa();        
        $response->write(json_encode($rnempresa->logar($login, $senha)));   

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->post('/api/empresa/salvar', function(Request $request, Response $response){

    try{
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
        $codigo = $request->getParam('cd_empresa');
    
        $empresa = new Empresa();
        if ($codigo != null){
            $empresa->setCdEmpresa($codigo);
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
        $response->write(json_encode($rnempresa));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->get('/api/empresa/{id}', function(Request $request, Response $response){

    try{
        $id = $request->getAttribute('id');

        $rnempresa = new RNEmpresa();        
        $empresa = new Empresa();
        $empresa->setCdEmpresa($id);
        $rnempresa = $rnempresa->pesquisar($empresa);
        $response->write(json_encode($rnempresa));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->get('/api/empresa/{id}/vagas', function(Request $request, Response $response){

    try{
        $id = $request->getAttribute('id');
 
        $rnempresa = new RNEmpresa();
        $empresa = new Empresa();
        $empresa->setCdEmpresa($id);
        $rnempresa = $rnempresa->pesquisarVagas($empresa);
        $response->write(json_encode($rnempresa));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});



//------- Profissional

$app->get('/api/profissionais', function(Request $request, Response $response){
    
    try{
        /*$sql = "SELECT * FROM profissional";

        $db = db::getInstance();

        $stmt = $db->query($sql);
        $profissional = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;*/

        $rnprofissional = new RNProfissional();
        $profissional = new Profissional();
        $rnprofissional = $rnprofissional->pesquisar($profissional);
        $response->write(json_encode($rnprofissional));

    } catch(PDOException $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});
$app->get('/api/profissional/login', function(Request $request, Response $response){
    
    try{
        $login = $request->getParam('login');
        $senha = $request->getParam('senha');    

        $rnprofissional = new RNProfissional();        
        $rnprofissional = $rnprofissional->logar($login, $senha);
        $response->write(json_encode($rnprofissional));

    } catch(PDOException $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});
$app->post('/api/profissional/salvar', function(Request $request, Response $response){

    try{
        $b_foto = $request->getParam('b_foto');
        $ds_senha = $request->getParam('ds_senha');
        $dt_nascimento = $request->getParam('dt_nascimento');
        $ds_email = $request->getParam('ds_email');
        $nr_latitude = $request->getParam('nr_latitude');
        $nr_longitude = $request->getParam('nr_longitude');
        $tp_conta = $request->getParam('tp_conta');
        $tp_sexo = $request->getParam('tp_sexo');
        $ds_nome = $request->getParam('ds_nome');   
    
        $profissional = new Profissional();

        $profissional->setBfoto($b_foto);
        $profissional->setDsSenha($ds_senha);
        $profissional->setDtNascimento($dt_nascimento);
        $profissional->setDsEmail($ds_email);
        $profissional->setNrlatitude($nr_latitude);
        $profissional->setNrlogitude($nr_longitude);
        $profissional->setTpconta($tp_conta);   
        $profissional->setTpsexo($tp_sexo);
        $profissional->setDsnome($ds_nome);

        $rnprofissional = new RNProfissional(); 
        $rnprofissional = $rnprofissional->cadastrar($profissional);
        $response->write(json_encode($rnprofissional)); 

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
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
        $response->write(json_encode($rnvaga));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->get('/api/profissional/vagas', function(Request $request, Response $response){
    
    try{
        $rnvagaprofissional = new RNVagaProfissional();
        $rnvagaprofissional = $rnvagaprofissional->listarVagasParaCandidatos($request->getParam('cd_profissional'));
        $response->write(json_encode($rnvagaprofissional));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

/**
 * Cadastro da vaga
 */
$app->post('/api/vaga/publicar', function(Request $request, Response $response){

    try{
        $vaga = new Vaga();
    	$cargo = new Cargo();
    	$empresa = new Empresa();

        $vaga->setNrQtdVaga($request->getParam('nr_qtd_vaga'));
        $vaga->setDsObservacao($request->getParam('ds_observacao'));
        $vaga->setDtValidade($request->getParam('dt_validade'));
        $vaga->setTpContratacao($request->getParam('tp_contratacao'));
        $vaga->setNrLongitude($request->getParam('nr_longitude'));
        $vaga->setNrLatitude($request->getParam('nr_latitude'));
        $vaga->setNrExperiencia($request->getParam('nr_experiencia'));
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

        //Pegando a lista de competencias_tecnicas no JSON e colocando na lista de competencias_tecnicas na vaga
        $competenciastecnicas = json_decode($request->getParam('competencias_tecnicas'), true);

        if ($competenciastecnicas != NULL){
            foreach ($competenciastecnicas as $key => $value) {
                $competenciatecnica = new CompetenciaTecnica();
                foreach ($value as $key => $value) {      
                    if($key == 'cd_competencia_tecnica')
                        $competenciatecnica->setCdCompetenciaTecnica($value); 
                    if($key == 'nr_nivel')
                        $competenciatecnica->setNrNivel($value);            
                }
                $vaga->setCompetenciasTecnicas($competenciatecnica); 
            }
        }

        //Pegando a lista de competencias_comport no JSON e colocando na lista de competencias_comport na vaga
        $competenciascomport = json_decode($request->getParam('competencias_comport'), true);

        if ($competenciascomport != NULL){
            foreach ($competenciascomport as $key => $value) {
                $competenciacomport = new CompetenciaComport();
                foreach ($value as $key => $value) {      
                    if($key == 'cd_competencia_comport')
                        $competenciacomport->setCdCompetenciaComport($value);           
                }
                $vaga->setCompetenciasComport($competenciacomport); 
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
        $rnvaga = new RNVaga();  
        $response->write(json_encode($rnvaga->publicar($vaga)));
         
    } catch(PDOException $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

/**
 * Curtir Vaga
 */
$app->post('/api/vaga/curtirVaga', function(Request $request, Response $response){

    try{
        $cd_vaga = ($request->getParam('cd_vaga'));
        $cd_profissional = ($request->getParam('cd_profissional'));
        $tp_acao = ($request->getParam('tp_acao'));
    
        $rnvagapro = new RNVagaProfissional();
        $result = $rnvagapro->curtirVaga($tp_acao,$cd_vaga,$cd_profissional);
        $response->write(json_encode($result));

    } catch(PDOException $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

//------ cargo

$app->get('/api/cargos', function(Request $request, Response $response){

    try{
        $cargo = new Cargo();
        $rncargo = new RNCargo();        
        $rncargo = $rncargo->pesquisar($cargo);
        $response->write(json_encode($rncargo));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

//------ curso

$app->get('/api/cursos', function(Request $request, Response $response){

    try{
        $curso = new Curso();
        $rncurso = new RNCurso();        
        $rncurso = $rncurso->pesquisar($curso);
        $response->write(json_encode($rncurso));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

//------ idioma

$app->get('/api/idiomas', function(Request $request, Response $response){

    try{
        $idioma = new Idioma();
        $rnidioma = new RNIdioma();        
        $rnidioma = $rnidioma->pesquisar($idioma);
        $response->write(json_encode($rnidioma));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

//------ competencias

$app->get('/api/competencias_tecnicas', function(Request $request, Response $response){

    try{
        $competenciatecnica = new CompetenciaTecnica();
        $rncompetenciatecnica = new RNCompetenciaTecnica();        
        $rncompetenciatecnica = $rncompetenciatecnica->pesquisar($competenciatecnica);
        $response->write(json_encode($rncompetenciatecnica));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});


$app->get('/api/competencias_comport', function(Request $request, Response $response){

    try{
        $competenciacomport = new CompetenciaComport();
        $rncompetenciacomport = new RNCompetenciaComport();        
        $rncompetenciacomport = $rncompetenciacomport->pesquisar($competenciacomport);
        $response->write(json_encode($rncompetenciacomport));
        
    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});




?>
