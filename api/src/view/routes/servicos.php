<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

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

$app->get('/api/empresas', function(Request $request, Response $response){
    $sql = "SELECT * FROM empresa";

    try{
        $db = new db();
        
        $db = $db->getInstance();

        $stmt = $db->query($sql);
        $empresa = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($empresa);
    } catch(PDOException $e){
        echo '{"Erro": {"texto": '.$e->getMessage().'}';
    }
});

$app->post('/api/empresa/login', function(Request $request, Response $response){
    
    $login = $request->getParam('login');
    $senha = $request->getParam('senha');    

    try{
        $rnempresa = new RNEmpresa();        
        $rnempresa = $rnempresa->logar($login, $senha);
        echo $rnempresa;   

    } catch(PDOException $e){
        echo '{"Erro": '.$e->getMessage().'}';
    }
});

$app->get('/api/empresa/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM usuario WHERE id = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customer);
    } catch(PDOException $e){
        echo '{"Erro": {"texto": '.$e->getMessage().'}';
    }
});

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
        echo '{"Erro": {"texto": '.$e->getMessage().'}';
    }
});

?>
