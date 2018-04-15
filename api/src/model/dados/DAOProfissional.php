<?php

require_once('../src/model/dados/idaoprofissional.php');

class DaoProfissional implements iDAOProfissional
{	
	function __construct(){
		
	}
	public function cadastrar(Profissional $u){
		try{
			$comando = "insert into profissional (b_foto,ds_senha,dt_nascimento,ds_email,nr_latitude,nr_longitude,tp_conta,tp_sexo,ds_nome) 
			            	 values (:b_foto,:ds_senha,:dt_nascimento,:ds_email,:nr_latitude,:nr_longitude,:tp_conta,:tp_sexo,:ds_nome)";
			$stmt = db::getInstance()->prepare($comando);
			$run = $stmt->execute(array(
	    			':b_foto' => $u->getBfoto(),
	    			':ds_senha' => $u->getDsSenha(),
	    			':dt_nascimento' => $u->getDtNascimento(),
					':ds_email' => $u->getDsEmail(),
					':nr_latitude' => $u->getNrlatitude(),
					':nr_longitude' => $u->getNrlogitude(),
					':tp_conta' => $u->getTpconta(),
					':tp_sexo' => $u->getTpsexo(),
					':ds_nome' => $u->getDsnome(),
	 		));
            $stmt->closeCursor();
	 	}catch(Exception $e){
			throw new Exception($e->getMessage());
		}finally{
			$stmt->closeCursor();
		}
	}
	public function alterar(Profissional $u){
		try{
			$comando = "update profissional set b_foto = :b_foto, ds_senha = :ds_senha, dt_nascimento = :dt_nascimento, ds_email = :ds_email,nr_latitude= :nr_latitude,nr_longitude = :nr_latitude,tp_conta= :tp_conta,tp_sexo = :tp_sexo,ds_nome = :ds_nome where cd_profissional = :cd_profissional";
			$stmt = db::getInstance()->prepare($comando);
			$run = $stmt->execute(array(
					':b_foto' => $u->getBfoto(),
	    			':ds_senha' => $u->getDsSenha(),
	    			':dt_nascimento' => $u->getDtNascimento(),
					':ds_email' => $u->getDsEmail(),
					':nr_latitude' => $u->getNrlatitude(),
					':nr_longitude' => $u->getNrlogitude(),
					':tp_conta' => $u->getTpconta(),
					':tp_sexo' => $u->getTpsexo(),
					':ds_nome' => $u->getDsnome(),
					':cd_profissional' => $u->getCdProfissional()
	 		));

 		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}finally{
			$stmt->closeCursor();
		}
	}
	public function excluir(Profissional $u){
	}
	public function pesquisar(Profissional $u, $alt='false'){
		try{
			$comando = 'select * from profissional ';
			$where = '';

			if (!empty($u->getDsSenha())){
				if (empty($where)){
					$where = ' where ds_senha = :senha';
				}else{
					$where = $where . ' and ds_senha = :senha';
				}
			}
			
			if (!empty($u->getDsEmail())){
				if (empty($where)){
					$where = ' where ds_email = :email';
				}else{
					$where = $where . ' and ds_email = :email';
				}
			}

			$stmt = db::getInstance()->prepare($comando . $where);
			if (!empty($u->getDsSenha()))
				$stmt->bindValue(':senha', $u->getDsSenha());
			if (!empty($u->getDsEmail()))
				$stmt->bindValue(':email', $u->getDsEmail());

			$run = $stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
	        return $result;

        }catch(Exception $e){
			throw new Exception($e->getMessage());
		}finally{
			$stmt->closeCursor();
		}
    }

    public function pesquisarById(Profissional $u, $alt='false'){
    	try{
	        $comando = 'select * from profissional WHERE cd_profissional = :cd_profissional';

	        $stmt = db::getInstance()->prepare($comando);

	        $run = $stmt->execute(array(':cd_profissional' => $u->getCdProfissional()));
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	        
        }catch(Exception $e){
			throw new Exception($e->getMessage());
		}finally{
			$stmt->closeCursor();
		}
    }

    /**
     * @param $cod_vaga
     * @return ArrayObject
     * @throws Exception
     */
    public function listarProfissionalVaga($cod_vaga)
    {
        try{
            $sql = 'select b_foto,
                           dt_nascimento,
                           profissional.cd_profissional,
                           profissional.ds_email,
                           profissional.nr_longitude,
                           tp_conta,
                           tp_sexo,
                           profissional.ds_nome,
                           profissional.nr_latitude,
                           vp.match_empresa
                      from profissional_vaga AS vp
                inner join vaga ON vp.cd_vaga = vaga.cd_vaga
                inner join profissional ON profissional.cd_profissional = vp.cd_profissional 
                     where 
                      vp.cd_vaga = :cod_vaga and 
                      vp.tp_acao = "Like";';

            $stmt = db::getInstance()->prepare($sql);

            if (!empty($cod_vaga))
                $stmt->bindValue(':cod_vaga', $cod_vaga);

            $run = $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $listaprofissional = new ArrayObject();
            foreach ($result as $row){
                $profissional = new profissional();
                $profissional->setBfoto($row['b_foto']);
                $profissional->setCdprofissional($row['cd_profissional']);
                $profissional->setDsEmail($row['ds_email']);
                $profissional->setDsnome($row['ds_nome']);
                $profissional->setTpconta($row['tp_conta']);
                $profissional->setTpsexo($row['tp_sexo']);
                $profissional->setNrlatitude($row['nr_latitude']);
                $profissional->setNrlogitude($row['nr_longitude']);
                $profissional->setMatchEmpresa($row['match_empresa']);
                $listaprofissional->append($profissional);
            }
            return $listaprofissional;

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }

    /**
     * @param $cd_profissional
     * @param string $alt
     * @return array
     * @throws Exception
     */
    public function listarVagaProfissional($cd_profissional, $alt='false'){
        try{
            $comando = 'select v.cd_vaga,v.nr_qtd_vaga,v.ds_observacao,v.dt_validade,v.tp_contratacao,v.nr_longitude,v.nr_latitude,v.ds_beneficios,
                               v.ds_horario_expediente,v.dt_criacao,v.ds_titulo,v.vl_salario,v.tp_status,v.nr_experiencia,v.ds_endereco,
                               c.cd_cargo,c.ds_cargo,
                               e.cd_empresa,e.ds_razao_social,e.ds_nome_fantasia,e.nr_porte,e.ds_nome_responsavel,e.ds_area_atuacao,e.ds_site,e.ds_telefone,e.nr_cnpj,e.ds_email,e.ds_senha,
                               ct.cd_competencia_tecnica,vct.nr_nivel,ct.ds_competencia_tecnica,
                               cc.cd_competencia_comport,cc.ds_competencia_comport,
                               vi.cd_idioma,i.ds_idioma,vi.nr_nivel
                          from vaga v
                    inner join cargo c ON c.cd_cargo = v.cd_cargo
                    inner join empresa e ON e.cd_empresa = v.cd_empresa
                    inner join vaga_competencia_tecnica vct ON vct.cd_vaga = v.cd_vaga
                    inner join competencia_tecnica ct ON ct.cd_competencia_tecnica = vct.cd_competencia_tecnica
                    inner join vaga_competencia_comport vcc ON vcc.cd_vaga = v.cd_vaga
                    inner join competencia_comport cc ON cc.cd_competencia_comport = vcc.cd_competencia_comport
                    inner join vaga_idioma AS vi ON vi.cd_vaga = v.cd_vaga
                    inner join idioma i ON vi.cd_idioma = i.cd_idioma
                         where v.cd_vaga not in (SELECT cd_vaga from profissional_vaga where cd_profissional = :cod_prof)
                      ORDER BY v.cd_vaga DESC
                         LIMIT 1;';

            //TODO JOIN vaga_curso AS vcurso ON vaga.cd_vaga = vcurso.cd_vaga , JOIN formacao AS f ON f.cd_formacao = vcurso.cd_formacao

            $stmt = db::getInstance()->prepare($comando);

            if (!empty($cd_profissional))
                $stmt->bindValue(':cod_prof', $cd_profissional);

            $run = $stmt->execute();

            $conversor = new conversorDeObjetos();

            //Lista de objetos vaga
            return $conversor->listarVagasParaCandidato($stmt->fetchAll(PDO::FETCH_ASSOC));

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }

    public function getNotificacoes($cd_profissional){
        try{
            $sql = 'select p.ds_nome,v.ds_titulo,e.ds_nome_fantasia 
                      from profissional_vaga as pv
                      JOIN
                        profissional p on pv.cd_profissional = p.cd_profissional
                      JOIN
                        vaga v on pv.cd_vaga = v.cd_vaga
                      JOIN empresa e on v.cd_empresa = e.cd_empresa
                    where p.cd_profissional = :cod_prof and match_empresa = 1;';
            $stmt = db::getInstance()->prepare($sql);

            if (!empty($cd_profissional))
                $stmt->bindValue(':cod_prof', $cd_profissional);

            $run = $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }catch (PDOException $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }

}
?>