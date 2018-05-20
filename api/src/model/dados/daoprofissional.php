<?php

require_once('../src/model/dados/idaoprofissional.php');

class DaoProfissional implements iDAOProfissional
{	
	function __construct(){
		
	}
	public function cadastrar(Profissional $profissional){
		try{
			$comando = "insert into profissional (b_foto,ds_senha,dt_nascimento,ds_email,nr_latitude,nr_longitude,tp_conta,tp_sexo,ds_nome) 
			            	 values (:b_foto,:ds_senha,:dt_nascimento,:ds_email,:nr_latitude,:nr_longitude,:tp_conta,:tp_sexo,:ds_nome)";
			$db = db::getInstance();
			$stmt = db::getInstance()->prepare($comando);
			$run = $stmt->execute(array(
	    			':b_foto' => $profissional->getBfoto(),
	    			':ds_senha' => $profissional->getDsSenha(),
	    			':dt_nascimento' => $profissional->getDtNascimento(),
					':ds_email' => $profissional->getDsEmail(),
					':nr_latitude' => $profissional->getNrlatitude(),
					':nr_longitude' => $profissional->getNrlogitude(),
					':tp_conta' => $profissional->getTpconta(),
					':tp_sexo' => $profissional->getTpsexo(),
					':ds_nome' => $profissional->getDsnome(),
	 		));
			$cd_profissional = $db->lastInsertId();
            $stmt->closeCursor();
            return $cd_profissional;
	 	}catch(Exception $e){
			throw new Exception($e->getMessage());
		}finally{
			$stmt->closeCursor();
		}
	}
	public function alterar(Profissional $profissional){
		try{
			$comando = "update profissional set b_foto = :b_foto, ds_senha = :ds_senha, dt_nascimento = :dt_nascimento, ds_email = :ds_email,nr_latitude= :nr_latitude,nr_longitude = :nr_latitude,tp_conta= :tp_conta,tp_sexo = :tp_sexo,ds_nome = :ds_nome where cd_profissional = :cd_profissional";
			$stmt = db::getInstance()->prepare($comando);
			$run = $stmt->execute(array(
					':b_foto' => $profissional->getBfoto(),
	    			':ds_senha' => $profissional->getDsSenha(),
	    			':dt_nascimento' => $profissional->getDtNascimento(),
					':ds_email' => $profissional->getDsEmail(),
					':nr_latitude' => $profissional->getNrlatitude(),
					':nr_longitude' => $profissional->getNrlogitude(),
					':tp_conta' => $profissional->getTpconta(),
					':tp_sexo' => $profissional->getTpsexo(),
					':ds_nome' => $profissional->getDsnome(),
					':cd_profissional' => $profissional->getCdProfissional()
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
                           profissional.ds_resultado_comp,
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

            $conversor = new conversorDeObjetos();

            return $conversor->parseRowsToObjectProfissional($stmt->fetchAll(PDO::FETCH_ASSOC));

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
            $comando = "SELECT v.cd_vaga,
            v.nr_qtd_vaga,
            v.ds_observacao,
            v.dt_validade,
            v.tp_contratacao,
            v.nr_longitude,
            v.nr_latitude,
            v.ds_beneficios,
            v.ds_horario_expediente,
            v.dt_criacao,
            v.ds_titulo,
            v.vl_salario,
            v.tp_status,
            v.nr_experiencia,
            v.ds_endereco,
            c.cd_cargo,
            c.ds_cargo,
            e.cd_empresa,
            e.ds_razao_social,
            e.ds_nome_fantasia,
            e.nr_porte,
            e.ds_nome_responsavel,
            e.ds_area_atuacao,
            e.ds_site,
            e.ds_telefone,
            e.nr_cnpj,
            e.ds_email,
            e.ds_senha,
            ct.cd_competencia_tecnica,
            vct.nr_nivel,
            ct.ds_competencia_tecnica,
            cc.cd_competencia_comport,
            cc.ds_competencia_comport,
            vi.cd_idioma,
            i.ds_idioma,
            vi.nr_nivel,
            p.cd_profissional,
            p.nr_longitude,
            p.nr_latitude,
            round(
                    (SELECT (6371 * acos( cos(radians(v.nr_latitude)) * cos(radians(p.nr_latitude)) * cos(radians(p.nr_longitude) - radians(v.nr_longitude)) + sin(radians(v.nr_latitude)) * sin(radians(p.nr_latitude)))))) distancia_km
     FROM vaga v
     INNER JOIN cargo c ON c.cd_cargo = v.cd_cargo
     INNER JOIN empresa e ON e.cd_empresa = v.cd_empresa
     INNER JOIN vaga_competencia_tecnica vct ON vct.cd_vaga = v.cd_vaga
     INNER JOIN competencia_tecnica ct ON ct.cd_competencia_tecnica = vct.cd_competencia_tecnica
     INNER JOIN vaga_competencia_comport vcc ON vcc.cd_vaga = v.cd_vaga
     INNER JOIN competencia_comport cc ON cc.cd_competencia_comport = vcc.cd_competencia_comport
     INNER JOIN vaga_idioma AS vi ON vi.cd_vaga = v.cd_vaga
     INNER JOIN idioma i ON vi.cd_idioma = i.cd_idioma
     INNER JOIN profissional p ON p.cd_profissional = :cod_prof
     WHERE v.cd_vaga NOT IN
         (SELECT cd_vaga
          FROM profissional_vaga
          WHERE cd_profissional = :cod_prof)
       AND v.tp_status = 'A'
	 HAVING distancia_km <= 60
     ORDER BY v.cd_vaga DESC
     LIMIT 1;";

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
    public function listarCursosProfissional($cd_profissional){
        try{
            $sql = 'select pc.cd_profissional,pc.cd_curso,c.ds_curso,pc.ds_instituicao,pc.dt_fim,pc.dt_inicio,pc.tp_certificado_validado,pc.nr_certificado,pc.nr_periodo
                      from profissional_curso as pc
                      JOIN
                        curso c on pc.cd_curso = c.cd_curso
                    where pc.cd_profissional = :cod_prof;';
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
    public function listarIdiomasProfissional($cd_profissional){
        try{
             $sql = 'SELECT
                   pi.cd_profissional,
                   pi.cd_idioma,
                   i.ds_idioma,
                  (CASE
                   WHEN pi.nr_nivel = 1 THEN "Básico"
                   WHEN pi.nr_nivel = 2 THEN "Médio"
                   ELSE "Avançado"
                   END) AS "nr_nivel"
                   FROM profissional_idioma AS pi
                   JOIN idioma i
                  ON pi.cd_idioma = i.cd_idioma
                  WHERE pi.cd_profissional = :cod_prof;';
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
    public function listarCompetenciasProfissional($cd_profissional){
        try{
            $sql = 'select pct.cd_profissional ,pct.cd_competencia_tecnica,ct.ds_competencia_tecnica,pct.nr_nivel
                      from profissional_competencia_tecnica as pct
                      JOIN
                      competencia_tecnica ct on pct.cd_competencia_tecnica = ct.cd_competencia_tecnica
                    where pct.cd_profissional = :cod_prof;';
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
    public function listarCargosProfissional($cd_profissional){
        try{
            $sql = 'select pc.cd_profissional,pc.cd_cargo,c.ds_cargo,pc.ds_empresa,pc.dt_fim,pc.dt_inicio
                      from profissional_cargo as pc
                      JOIN
                      cargo c on pc.cd_cargo = c.cd_cargo
                      where pc.cd_profissional = :cod_prof;';
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
    public function updateToken($cd_profissional,$token){
        try{
            $sql = 'update profissional set token = :token where cd_profissional = :cd_profissional;';
            $stmt = db::getInstance()->prepare($sql);

            if (!empty($cd_profissional))
                $stmt->bindValue(':cd_profissional', $cd_profissional);
                $stmt->bindValue(':token', $token);

            $run = $stmt->execute();

        }catch (PDOException $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }

}
?>
