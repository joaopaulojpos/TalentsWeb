<?php
    require_once('../../model/basica/empresa.php');
    require_once('../../model/dados/daoempresa.php');
    require_once('../../model/basica/vaga.php');
    require_once('../../model/dados/daovaga.php');
    require_once('../../model/basica/cargo.php');
    require_once('../../model/dados/daocargo.php');
    require_once('../../model/basica/idioma.php');
    require_once('../../model/dados/daoidioma.php');
    require_once('../../model/basica/curso.php');
    require_once('../../model/dados/daocurso.php');
    require_once('../../model/basica/competenciatecnica.php');
    require_once('../../model/dados/daocompetenciatecnica.php');
    require_once('../../model/basica/competenciacomport.php');
    require_once('../../model/dados/daocompetenciacomport.php');
    require_once('../../model/basica/pagamento.php');
    require_once('../../model/dados/daopagamento.php');


    class Fachada {

    //USANDO PDO
    public static $instance;
    public function __construct() {

    }
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Fachada();
        }
        return self::$instance;
    }


    //EMPRESA
    public function empresaCadastrar($empresa){
        $daoempresa = new DaoEmpresa();
        $result = json_decode($daoempresa->cadastrar($empresa));
        
        return json_decode(json_encode($result, true));
    }

    public function empresaLogar($login, $senha){
        $daoempresa = new DaoEmpresa();
        $empresa = new Empresa();
        $empresa->setDsEmail($login);
        $empresa->setDsSenha($senha);
        return json_decode($daoempresa->logar($empresa), true);
    }

    //Vaga
    public function publicarVaga($cd_vaga){
        try{
            $daovaga = new DAOVaga();
            return json_decode($daovaga->publicar($cd_vaga), true);
        }catch(Exception $e){
            return array('erro' => 'Erro ao publicar vaga!' );
        }
    }  

    public function salvarVaga($vaga){
        try{
            $daovaga = new DAOVaga();
            return json_decode($daovaga->salvar($vaga), true);
        }catch(Exception $e){
            return array('erro' => 'Erro ao salvar vaga!' );
        }
    } 

    public function fecharVaga($cd_vaga){
        try{
            $daovaga = new DAOVaga();
            return json_decode($daovaga->fechar($cd_vaga), true);
        }catch(Exception $e){
            return array('erro' => 'Erro ao fechar vaga!' );
        }
    }

    public function vagasEmpresaPesquisar($cd_empresa){
        $daoempresa = new DaoEmpresa();
        return json_decode($daoempresa->vagasEmpresaPesquisar($cd_empresa), true);
    }

    public function vagaPesquisar($cd_vaga){
        try{
            $daovaga = new DAOVaga();
            return json_decode($daovaga->pesquisarVaga($cd_vaga), true);
        }catch(Exception $e){
            return array($e->getMessage());
        }
    }

    public function listarProfissionaisVaga($cd_vaga){
        $daovaga = new DAOVaga();
        return json_decode($daovaga->listarProfissionaisVaga($cd_vaga), true);
    }

    public function likeProfissionalVaga($cd_vaga, $cd_profissional){
        $daovaga = new DAOVaga();
        return json_decode($daovaga->likeProfissionalVaga($cd_vaga, $cd_profissional), true);
    }

    //Cargo
    public function cargoPesquisar(){
        $daocargo = new DAOCargo();
        $cargo = new Cargo();
        $result = json_decode($daocargo->pesquisar($cargo));
        
        return json_decode(json_encode($result, true));
    }

    //Idioma
    public function idiomaPesquisar(){
        $daoidioma = new DAOIdioma();
        $idioma = new Idioma();
        $result = json_decode($daoidioma->pesquisar($idioma));

        return json_decode(json_encode($result, true));
    }

    //Curso
    public function cursoPesquisar(){
        $daocurso = new DAOCurso();
        $curso = new Curso();
        $result = json_decode($daocurso->pesquisar($curso));

        return json_decode(json_encode($result, true));
    }

    //competencias
    public function competenciaTecnicaPesquisar(){
        $daocompetenciatecnica = new DAOCompetenciaTecnica();
        $competenciatecnica = new competenciaTecnica();
        $result = json_decode($daocompetenciatecnica->pesquisar($competenciatecnica));

        return json_decode(json_encode($result, true));
    }
    public function competenciaComportPesquisar(){
        $daocompetenciacomport = new DAOCompetenciaComport();
        $competenciacomport = new competenciaComport();
        $result = json_decode($daocompetenciacomport->pesquisar($competenciacomport));

        return json_decode(json_encode($result, true));
    }

    //Pagamento

    public function pagamentoCadastrar($pagamento){
        try{
            $daopagamento = new DAOPagamento();
            return json_decode($daopagamento->cadastrar($pagamento), true);
        }catch(Exception $e){
            return array('erro' => 'Erro ao criar pagamento!' );
        }
    }

    public function pagamentoFinalizar($pagamento){
        try{
            $daopagamento = new DAOPagamento();
            return json_decode($daopagamento->finalizar($pagamento), true);
        }catch(Exception $e){
            return array('erro' => 'Erro ao finalizar pagamento!' );
        }
    }
}