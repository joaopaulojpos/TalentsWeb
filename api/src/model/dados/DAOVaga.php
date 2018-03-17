<?php

require_once('idaovaga.php');

class DaoVaga implements iDAOVaga
{
    function __construct(){}

    /**
     * @param vaga $vaga
     * @return string
     */
    public function publicar(vaga $vaga){
        //Comando para inserir a vaga na base de dados
        $sql = "insert into vaga (nr_qtd_vaga,ds_observacao,dt_validade,tp_contratacao,nr_longitude,nr_latitude,ds_beneficios,ds_horario_expediente,dt_criacao,ds_titulo,vl_salario,cd_cargo,cd_empresa)
            values (:nr_qtd_vaga,:ds_observacao,:dt_validade,:tp_contratacao,:nr_longitude,:nr_latitude,:ds_beneficios,:ds_horario_expediente,:dt_criacao,:ds_titulo,:vl_salario,:cd_cargo,:cd_empresa);";
        try {
            $db = db::getInstance();
            $stmt = $db->prepare($sql);
            $run = $stmt->execute(array(
                ':nr_qtd_vaga' => $vaga->getNrQtdVaga(),
                ':ds_observacao' => $vaga->getDsObservacao(),
                ':dt_validade' => $vaga->getDtValidade(),
                ':tp_contratacao' => $vaga->getTpContratacao(),
                ':nr_longitude' => $vaga->getNrLongitude(),
                ':nr_latitude' => $vaga->getNrLatitude(),
                ':ds_beneficios' => $vaga->getDsBeneficios(),
                ':ds_horario_expediente' => $vaga->getDsHorarioExpediente(),
                ':dt_criacao' => $vaga->getDtCriacao(),
                ':ds_titulo' => $vaga->getDsTitulo(),
                ':vl_salario' => $vaga->getVlSalario(),
                ':cd_cargo' => $vaga->getCargo()->getCdCargo(),
                ':cd_empresa' => $vaga->getEmpresa()->getCdEmpresa()

            ));
            //Guardando o id da última insersão para utiliza-lo
            $cdvaga = $db->lastInsertId();

            //Pegando os idiomas na lista na vaga e inserindo associando com o código da vaga
            foreach ($vaga->getIdiomas() as $idioma) {

                $daoidiomas = new DaoIdioma();
                $daoidiomas->inserirIdiomaVaga($cdvaga, $idioma);

            }

            //Pegando as habilidades na lista na vagas inserindo associando com o código da vaga
            foreach ($vaga->getHabilidades() as $habil) {

                $daohabilidade = new DaoHabilidade();
                $daohabilidade->inserirHabilidadeVaga($cdvaga, $habil);

            }

        }catch (Exception $e){

            return $e->getMessage();

        }
    }

    /**
     * @param Vaga $vaga
     * @param string $alt
     * @return array
     */
    public function pesquisar(Vaga $vaga, $alt='false'){

        $comando = 'select vaga.cd_vaga,nr_qtd_vaga,ds_observacao,dt_validade,tp_contratacao,nr_longitude,nr_latitude,
                      ds_beneficios,ds_horario_expediente,dt_criacao,ds_titulo,vl_salario,cargo.cd_cargo,ds_cargo,
                      empresa.cd_empresa,ds_razao_social,ds_nome_fantasia,nr_porte,ds_nome_responsavel,ds_area_atuacao,ds_site,
                      ds_telefone,nr_cnpj,ds_email,ds_senha,habilidade.cd_habilidade,vaga_habilidade.nr_nivel,
                      habilidade.ds_habilidade,vi.cd_idioma,ds_idioma,vi.nr_nivel
                      from vaga
                      JOIN cargo ON cargo.cd_cargo = vaga.cd_cargo
                      JOIN empresa ON empresa.cd_empresa = vaga.cd_empresa
                      JOIN vaga_habilidade AS vaga_habilidade ON vaga_habilidade.cd_vaga = vaga.cd_vaga
                      JOIN habilidade ON habilidade.cd_habilidade = vaga_habilidade.cd_habilidade
                      JOIN vaga_idioma AS vi ON vi.cd_vaga = vaga.cd_vaga
                      JOIN idioma ON vi.cd_idioma = idioma.cd_idioma;';

//TODO JOIN vaga_curso AS vcurso ON vaga.cd_vaga = vcurso.cd_vaga , JOIN formacao AS f ON f.cd_formacao = vcurso.cd_formacao

        $where = '';

        if (!empty($vaga->getCdVaga())){

            if (empty($where)){

                $where = ' where vaga.cd_vaga = :cd_vaga';

            }else{

                $where = $where . ' and vaga.cd_vaga = :cd_vaga';

            }

        }
        
        $db = new db();
        $stmt = db::getInstance()->prepare($comando . $where);

        if (!empty($vaga->getCdVaga()))
            $stmt->bindValue(':cd_vaga', $vaga->getCdVaga());

        $run = $stmt->execute();

        //Lista de objetos vaga
        return $this->parseRowsToObjectVaga($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

//--------------------------------------------- AUXILIARES -----------------------------------------------------------
    /**
     * Método responsável por transformar as linhas do banco na classe vaga
     * @param $result com o resultado do PDO::Fetch
     * @return ArrayObject uma lista de vagas
     */
    private function parseRowsToObjectVaga($result){
        $cd_vaga = 0;
        $listavagas = new ArrayObject();
        $daohabilidade = new daohabilidade();
        $daoidioma = new daoidioma();

        foreach ($result as $row) {

            //Verifica o código da vaga, para não inserir duplicado
            if ($cd_vaga <> $row['cd_vaga']) {

                $vaga = new Vaga();
                $cargo = new Cargo;
                $empresa = new Empresa();
                $vaga->setCdVaga($row['cd_vaga']);
                $vaga->setNrQtdVaga($row['nr_qtd_vaga']);
                $vaga->setDsObservacao($row['ds_observacao']);
                $vaga->setDtValidade($row['dt_validade']);
                $vaga->setTpContratacao($row['tp_contratacao']);
                $vaga->setNrLongitude($row['nr_longitude']);
                $vaga->setNrLatitude($row['nr_latitude']);
                $vaga->setDsBeneficios($row['ds_beneficios']);
                $vaga->setDsHorarioExpediente($row['ds_horario_expediente']);
                $vaga->setDtCriacao($row['dt_criacao']);
                $vaga->setDsTitulo($row['ds_titulo']);
                $vaga->setVlSalario($row['vl_salario']);

                //Cargo
                $cargo->setCdCargo($row['cd_cargo']);
                $cargo->setDsCargo($row['ds_cargo']);
                $vaga->setCargo($cargo);

                //Empresa
                $empresa->setCdEmpresa($row['cd_empresa']);
                $empresa->setDsAreaAtuacao($row['ds_area_atuacao']);
                $empresa->setDsEmail($row['ds_email']);
                $empresa->setDsNomeFantasia($row['ds_nome_fantasia']);
                $empresa->setDsRazaoSocial($row['ds_razao_social']);
                $empresa->setDsResponsavelCadastro($row['ds_nome_responsavel']);
                $empresa->setDsSenha($row['ds_senha']);
                $empresa->setDsSite($row['ds_site']);
                $empresa->setNrCnpj($row['nr_cnpj']);
                $empresa->setNrPorte($row['nr_porte']);
                $empresa->setDsTelefone($row['ds_telefone']);
                $vaga->setEmpresa($empresa);

                //TODO Listar dos profissionais e cursos
                /*Profissionais que curtiram a vaga
                foreach ($daoprofissional->listarProfissionalVaga($vaga->getCdVaga()) as $p) {

                    $vaga->setProfissionais($p);

                }*/

                /*Cursos
                foreach ($daocurso->listarCursoVaga($vaga->getCdVaga()) as $c) {

                    $vaga->setCursos($c);

                }*/

                //Habilidades
                foreach ($daohabilidade->listarHabilidadeVaga($vaga->getCdVaga()) as $h) {

                    $vaga->setHabilidades($h);

                }

                //Idiomas
                foreach ($daoidioma->listarIdiomaVaga($vaga->getCdVaga()) as $i) {

                    $vaga->setIdiomas($i);

                }

                //Adiciona uma vaga na lista de vagas
                $listavagas->append($vaga);
                //modifica o atributo com o código da vaga atual
                $cd_vaga=$row['cd_vaga'];

            }

        }

        //Retorna a lista de vagas
        return $listavagas;

    }

}

 ?>