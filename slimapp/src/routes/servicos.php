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

$app->get('/api/usuarios', function(Request $request, Response $response){
    $sql = "SELECT * FROM usuario";

    try{
        $db = new db();
        
        $db = $db->connect();

        $stmt = $db->query($sql);
        $usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($usuario);
    } catch(PDOException $e){
        echo '{"Erro": {"texto": '.$e->getMessage().'}';
    }
});

$app->get('/api/usuario/{id}', function(Request $request, Response $response){
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

$app->post('/api/usuario/add', function(Request $request, Response $response){
    $nome = $request->getParam('nome');
    $email = $request->getParam('email');
    $senha = $request->getParam('senha');
    $celular = $request->getParam('celular');

    $sql = "INSERT INTO usuario (nome,email,senha,celular) VALUES
    (:nome,:email,:senha,:celular)";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email',  $email);
        $stmt->bindParam(':senha',      $senha);
        $stmt->bindParam(':celular',    $celular);

        $stmt->execute();

        echo '{"Status": {"texto": "Usuario Adicionado"}';

    } catch(PDOException $e){
        echo '{"Erro": {"texto": '.$e->getMessage().'}';
    }
});


$app->put('/api/usuario/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $nome = $request->getParam('nome');
    $email = $request->getParam('email');
    $senha = $request->getParam('senha');
    $celular = $request->getParam('celular');

    $sql = "UPDATE usuario SET
				nome 	= :nome,
				email 	= :email,
                senha		= :senha,
                celular 	= :celular
			WHERE id = $id";

    try{

        $db = new db();

        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email',  $email);
        $stmt->bindParam(':senha',      $senha);
        $stmt->bindParam(':celular',    $celular);

        $stmt->execute();

        echo '{"Status": {"texto": "Usuario Atualizado}';

    } catch(PDOException $e){
        echo '{"Erro": {"texto": '.$e->getMessage().'}';
    }
});

$app->delete('/api/usuario/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM usuario WHERE id = $id";

    try{
        $db = new db();
        
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"Status": {"texto": "Usuario Deletado"}';
    } catch(PDOException $e){
        echo '{"Erro": {"texto": '.$e->getMessage().'}';
    }
});

$app->get('/api/vagas', function(Request $request, Response $response){
    $sql = "SELECT * FROM vagas";

    try{
        $db = new db();
        
        $db = $db->connect();

        $stmt = $db->query($sql);
        $vaga = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($vaga);
    } catch(PDOException $e){
        echo '{"Erro": {"texto": '.$e->getMessage().'}';
    }
});