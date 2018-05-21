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


$app->post('/api/empresa/match', function(Request $request, Response $response){

    try{

        $cd_vaga = $request->getParam('cd_vaga');
        $cd_profissional = $request->getParam('cd_profissional');

        $rnempresa = new RNEmpresa();
        $rnempresa = $rnempresa->match($cd_vaga,$cd_profissional);
        $response->write(json_encode($rnempresa));


		//$req->get("https://fcm.googleapis.com/fcm/send");
		/*

Content-Type:application/json
Authorization:key=AIzaSyZ-1u...0GBYzPu7Udno5aA
{
  "to" : "/topics/foo-bar",
  "priority" : "high",
  "notification" : {
    "body" : "This is a Firebase Cloud Messaging Topic Message!",
    "title" : "FCM Message",
  }
}
		*/

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});


//------- Profissional

$app->get('/api/profissionais', function(Request $request, Response $response){
    
    try{
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
        $codigo = $request->getParam('cd_profissional');

        $profissional = new Profissional();
        if ($codigo != null){
            $profissional->setCdProfissional($codigo);
        }

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
        $rnprofissional = $rnprofissional->salvar($profissional);
        $response->write(json_encode($rnprofissional));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->get('/api/profissional/notificacoes', function(Request $request, Response $response){

    try{
        $rnprofissional = new RNProfissional();
        $rnprofissional = $rnprofissional->getNotificacao($request->getParam('cd_profissional'));
        $response->write(json_encode($rnprofissional));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->post('/api/profissional/idioma', function(Request $request, Response $response){

    try{
        $cd_profissional = $request->getParam('cd_profissional');
        $cd_idioma = $request->getParam('cd_idioma');
        $nr_nivel = $request->getParam('nr_nivel');

        $rnidioma = new RNIdioma();
        $rnidioma= $rnidioma->inserirIdiomaProfissional($cd_profissional,$cd_idioma,$nr_nivel);
        $response->write(json_encode($rnidioma));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->post('/api/profissional/curso', function(Request $request, Response $response){

    try{
        $cd_profissional = $request->getParam('cd_profissional');
        $cd_curso= $request->getParam('cd_curso');
        $ds_instituicao= $request->getParam('ds_instituicao');
        $dt_fim= $request->getParam('dt_fim');
        $dt_inicio= $request->getParam('dt_inicio');
        $nr_certificado= $request->getParam('nr_certificado');
        $tp_certificado_validado= $request->getParam('tp_certificado_validado');
        $nr_periodo= $request->getParam('nr_periodo');

        $rncurso = new RNCurso();
        $rncurso = $rncurso->inserirCursoProfissional($cd_profissional, $cd_curso, $ds_instituicao, $dt_fim, $dt_inicio, $nr_certificado, $tp_certificado_validado, $nr_periodo);
        $response->write(json_encode($rncurso));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->post('/api/profissional/competencia_tecnica', function(Request $request, Response $response){

    try{
        $cd_profissional = $request->getParam('cd_profissional');
        $cd_competencia_tecnica = $request->getParam('cd_competencia_tecnica');
        $nr_nivel = $request->getParam('nr_nivel');

        $rncompetenciatecnica = new RNCompetenciaTecnica();
        $rncompetenciatecnica = $rncompetenciatecnica->inserirCompetenciaTecnicaProfissional($cd_profissional,$cd_competencia_tecnica,$nr_nivel);
        $response->write(json_encode($rncompetenciatecnica));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->post('/api/profissional/cargo', function(Request $request, Response $response){

    try{
        $cd_profissional = $request->getParam('cd_profissional');
        $cd_cargo = $request->getParam('cd_cargo');
        $ds_empresa = $request->getParam('ds_empresa');
        $dt_inicio = $request->getParam('dt_inicio');
        $dt_fim = $request->getParam('dt_fim');

        $rncargo = new RNCargo();
        $rncargo = $rncargo->inserirCargoProfissional($cd_profissional,$cd_cargo,$ds_empresa,$dt_inicio,$dt_fim);
        $response->write(json_encode($rncargo));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->post('/api/profissional/updateToken', function(Request $request, Response $response){

    try{
        $cd_profissional = $request->getParam('cd_profissional');
        $token = $request->getParam('token');

        $rncargo = new RNProfissional();
        $rncargo = $rncargo->updateToken($cd_profissional,$token);
        $response->write(json_encode($rncargo));

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

/**
* Visualiza vaga
*/
$app->get('/api/vaga/buscar/{id}', function(Request $request, Response $response){
    
    try{
        $id = $request->getAttribute('id');
        $vaga = new Vaga();
        $vaga->setCdVaga($id);
        $empresa = new Empresa();
        $vaga->setEmpresa($empresa);
        $rnvaga = new RNVaga();        
        $rnvaga = $rnvaga->pesquisar($vaga);
        $response->write(json_encode($rnvaga));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->get('/api/profissional/vagas', function(Request $request, Response $response){
    
    try{
        $rnprofissional = new RNProfissional();
        $rnprofissional = $rnprofissional->listarVagasParaCandidatos($request->getParam('cd_profissional'));
        $response->write(json_encode($rnprofissional));

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->get('/api/vaga/{id}/profissionais', function(Request $request, Response $response){
    
    try{
        $id = $request->getAttribute('id');

        $rnprofissional = new RNProfissional();
        $result = $rnprofissional->listarProfissionalVaga($id);
        $response->write(json_encode($result));
        

    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

/**
 * Cadastro da vaga
 */
$app->post('/api/vaga/salvar', function(Request $request, Response $response){

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
        $vaga->setDsEndereco($request->getParam('ds_endereco'));
    	$cargo->setCdCargo($request->getParam('cd_cargo'));
    	$vaga->setCargo($cargo);
    	$empresa->setCdEmpresa($request->getParam('cd_empresa'));
    	$vaga->setEmpresa($empresa);

        $vaga->setTpStatus($request->getParam('tp_status'));

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
        $response->write(json_encode($rnvaga->salvar($vaga)));
         
    } catch(PDOException $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

/**
 * Publicar Vaga
 */
$app->post('/api/vaga/publicar', function(Request $request, Response $response){

    try{
        $cd_vaga = $request->getParam('cd_vaga');
    
        $rnvaga = new RNVaga();
        $result = $rnvaga->publicar($cd_vaga);
        $response->write(json_encode($result));

    } catch(PDOException $e){
        $response->write(json_encode(array('error' => $e->getMessage())));
    }
});

$app->post('/api/vaga/fechar', function(Request $request, Response $response){

    try{
        $cd_vaga = ($request->getParam('cd_vaga'));
    
        $rnvaga = new RNVaga();
        $result = $rnvaga->fecharVaga($cd_vaga);
        $response->write(json_encode($result));

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
    
        $rnvaga = new RNVaga();
        $result = $rnvaga->curtirVaga($tp_acao,$cd_vaga,$cd_profissional);
        $response->write(json_encode($result));

    } catch(PDOException $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});
$app->get('/api/teste', function(Request $request, Response $response){

    $response->write('Testando post para notifications');
});
/**
 * Like profissional da vaga
 */
$app->post('/api/vaga/like/profissional', function(Request $request, Response $response){

    try {
        $cd_vaga = ($request->getParam('cd_vaga'));
        $cd_profissional = ($request->getParam('cd_profissional'));

        $rnvaga = new RNVaga();
        $result = $rnvaga->likeProfissionalVaga($cd_vaga, $cd_profissional);
        $sendnotification = new sendnotificationtofcm();
        $resultnotification = $sendnotification->sendtotopic($result['topic'],'');


        $response->write(json_encode($result));
    }
    catch
        (PDOException $e){
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
$app->get('/api/profissional/cargos', function(Request $request, Response $response){
    
    try{
        $rnprofissional = new RNProfissional();
        $rnprofissional = $rnprofissional->listarCargosCandidatos($request->getParam('cd_profissional'));
        $response->write(json_encode($rnprofissional));

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

$app->get('/api/profissional/cursos', function(Request $request, Response $response){
    
    try{
        $rnprofissional = new RNProfissional();
        $rnprofissional = $rnprofissional->listarCursosCandidatos($request->getParam('cd_profissional'));
        $response->write(json_encode($rnprofissional));

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

$app->get('/api/profissional/idiomas', function(Request $request, Response $response){
    
    try{
        $rnprofissional = new RNProfissional();
        $rnprofissional = $rnprofissional->listarIdiomasCandidatos($request->getParam('cd_profissional'));
        $response->write(json_encode($rnprofissional));

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
$app->get('/api/profissional/competencias_tecnicas', function(Request $request, Response $response){
    
    try{
        $rnprofissional = new RNProfissional();
        $rnprofissional = $rnprofissional->listarCompetenciasCandidatos($request->getParam('cd_profissional'));
        $response->write(json_encode($rnprofissional));

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




$app->get('/api/pergunta_perfil_comp', function(Request $request, Response $response){

    try{
        $perguntaperfilcomp = new perguntaperfilcomp();
        $rNPerguntaperfilcomp = new RNPerguntaperfilcomp();        
        $rNPerguntaperfilcomp = $rNPerguntaperfilcomp->listarPerguntas();
        $response->write(json_encode($rNPerguntaperfilcomp));
        
    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});




$app->get('/api/alternativa_perfil_comp', function(Request $request, Response $response){

    try{
        $alternativaperfilcomp = new alternativaperfilcomp();
        $rNalternativaperfilcomp = new RNalternativaperfilcomp();        
        $rNalternativaperfilcomp = $rNalternativaperfilcomp->pesquisar($alternativaperfilcomp);
        $response->write(json_encode($rNalternativaperfilcomp));
        
    } catch(Exception $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});


$app->post('/api/inserir_resposta', function(Request $request, Response $response){

    try{
        $Resposta = ($request->getParam('cd_alternativa_perfil_comp'));
        $cd_profissional = ($request->getParam('cd_profissional'));
        $CdPergunta = ($request->getParam('cd_pergunta_perfil_comp'));


    
        $rNPerguntaperfilcomp = new RNPerguntaperfilcomp();
        $result = $rNPerguntaperfilcomp->cadastrarResposta($CdPergunta,$cd_profissional,$Resposta);
        $response->write(json_encode($result));

    } catch(PDOException $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});


$app->post('/api/CalculoPerfilComp', function(Request $request, Response $response){

    try{

        $cd_profissional = ($request->getParam('cd_profissional'));


    
        $rNPerguntaperfilcomp = new RNPerguntaperfilcomp();
        $result = $rNPerguntaperfilcomp->CalculoPerfilComp($cd_profissional);
        $response->write(json_encode($result));

    } catch(PDOException $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

//pagamentos

$app->post('/api/pagamento', function(Request $request, Response $response){

    try{

        $cd_empresa = ($request->getParam('cd_empresa'));
        $token = ($request->getParam('token'));
        $vl_recarga = ($request->getParam('vl_recarga'));
        $tp_status = 'F';

        $pagamento = new Pagamento();
        $pagamento->setCdEmpresa($cd_empresa);
        $pagamento->setToken($token);
        $pagamento->setVlRecarga($vl_recarga);
        $pagamento->setTpStatus($tp_status);

        $rnpagamento = new RNPagamento();
        $result = $rnpagamento->cadastrar($pagamento);
        $response->write(json_encode($result));

    } catch(PDOException $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});

$app->post('/api/pagamento/finalizar', function(Request $request, Response $response){

    try{
        $token = ($request->getParam('token'));
        $payerid = ($request->getParam('payerid'));
        $tp_status = ($request->getParam('tp_status'));

        $pagamento = new Pagamento();
        $pagamento->setToken($token);
        $pagamento->setTpStatus($tp_status);
        $pagamento->setPayerId($payerid);

        $rnpagamento = new RNPagamento();
        $result = $rnpagamento->finalizar($pagamento);
        $response->write(json_encode($result));

    } catch(PDOException $e){
        $response->write(json_encode(array('erro' => $e->getMessage())));
    }
});



?>
