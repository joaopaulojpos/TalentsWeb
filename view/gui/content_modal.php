    <!-- ARQUIVO DO PROFISSIONAL DO PROFISSIONAL (MODAL) -->

    <!-- LAYOUT DOS CANDIDATOS APTOS -->

<td>
    <div id="modal<?php echo $cd_profissional?>" class="modal modal-fixed-footer <?php echo $cor_fundo; ?> darken-2">
        <div class="modal-content">
            <div class="row">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="<?php echo $b_foto; ?>" align="left" width="150" height="150">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content" style="padding: 0px 0px 0px 10px;">
                            <h6><b>Nome: </b> <?php echo $ds_nome; ?></h6>
                            <h6><b>Email: </b> <?php echo $ds_email; ?></h6>
                            <h6><b>Data de Nascimento: </b> <?php echo $dt_nascimento; ?></h6>
                            <h6><b>Sexo: </b> <?php echo $sexo; ?></h6>
                            <h6><b>Distância da Vaga: </b> <?php echo $distancia . " km"; ?></h6>
                            <h6><b>Perfil Comportamental: </b> <?php echo $ds_resultado_comp; ?></h6>
                        </div>
                    </div>
                </div>

                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">business_center</i>Experiência(s) Profissional(is) - <?php echo $qtdExp; ?></div>
                            <div class="collapsible-body white darken-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Cargo</th>
                                            <th>Empresa</th>
                                            <th>Data Início</th>
                                            <th>Data Fim</th>
                                        </tr>
                                    </thead>
                                            
                                    <tbody>
                                        <?php 
                                            if ($value["cargos"]){
                                            foreach ($value["cargos"] as $key => $cargos) {              
                                            ?>   
                                            <tr>
                                                <td><?php echo $cargos['ds_cargo']; ?></td>
                                                <td><?php echo $cargos['ds_empresa']; ?></td>
                                                <td><?php echo $cargos['dt_inicio']!=''? date('d/m/Y', strtotime($cargos['dt_inicio'])) : '-' ?></td>
                                                <td><?php echo $cargos['dt_fim']!=''? date('d/m/Y', strtotime($cargos['dt_fim'])) : '-' ?></td>                                                                               
                                            </tr>
                                                <?php 
                                                        }
                                                    } 
                                                ?> 
                                    </tbody>
                                </table>
                            </div>
                    </li>
                </ul>

                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">school</i>Educação - <?php echo $qtdCursos; ?></div>
                            <div class="collapsible-body white darken-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Curso</th>
                                                <th>Instituição</th>
                                                <th>Data Início</th>
                                                <th>Data Fim</th>
                                                <th>Período</th>
                                                <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if ($value["cursos"]){
                                            foreach ($value["cursos"] as $key => $cursos) {              
                                        ?>   
                                            <tr>
                                                <td><?php echo $cursos['ds_curso']; ?></td>
                                                <td><?php echo $cursos['ds_instituicao']; ?></td>
                                                <td><?php echo $cursos['dt_inicio']!=''? date('d/m/Y', strtotime($cursos['dt_inicio'])) : '-' ?></td>
                                                <td><?php echo $cursos['dt_fim']!=''? date('d/m/Y', strtotime($cursos['dt_fim'])) : '-' ?></td>
                                                <td><?php echo $cursos['nr_periodo']; ?></td>
                                                <td style="float:right;">
                                                    <?php
                                                        $percent_curso = (double) number_format(((in_array_field($cursos['cd_curso'], 'cd_curso', $cursos_vaga)) * 100), 2, ',', ' ');
                                                        if ($percent_curso <= 10){
                                                            $estrela_curso = 0;
                                                        }else {
                                                            $estrela_curso = 5;
                                                        }

                                                        echo '<img src="http://plataformatalent.tmp.k8.com.br/view/gui/images/estrela_small_'.$estrela_curso.'.png" />'

                                                    ?>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                                    } 
                                            ?> 
                                    </tbody>
                                </table>
                            </div>
                    </li>
                </ul>

                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">poll</i>Competência(s) Técnica(s) - <?php echo $qtdCompTec; ?></div>
                            <div class="collapsible-body white darken-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Competência</th>
                                            <th>Nível</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if ($value["competencias_tecnicas"]){
                                                foreach ($value["competencias_tecnicas"] as $key => $comp_tec) {              
                                            ?>   
                                        <tr>
                                            <td><?php echo $comp_tec['ds_competencia_tecnica']; ?></td>
                                            <td><?php echo $comp_tec['nr_nivel']; ?></td>
                                            <td style="float:right;">
                                                <?php
                                                    $percent_comp_tec = (double) number_format(((in_percent($comp_tec['cd_competencia_tecnica'], $comp_tec['nr_nivel'], 'cd_competencia_tecnica', $competencias_tecnicas_vaga)) * 100), 2, ',', ' ');
                                                    if ($percent_comp_tec < 20){
                                                        $estrela_comp_tec = 0;
                                                    }else if ($percent_comp_tec == 20){
                                                        $estrela_comp_tec = 1;
                                                    }else if ($percent_comp_tec > 20 && $percent_comp_tec <= 40){
                                                        $estrela_comp_tec = 2;
                                                    }else if ($percent_comp_tec > 40 && $percent_comp_tec <= 60){
                                                        $estrela_comp_tec = 3;
                                                    }else if ($percent_comp_tec > 60 && $percent_comp_tec <= 80){
                                                        $estrela_comp_tec = 4;
                                                    }else {
                                                        $estrela_comp_tec = 5;
                                                    }

                                                    echo '<img src="http://plataformatalent.tmp.k8.com.br/view/gui/images/estrela_small_'.$estrela_comp_tec.'.png" />'

                                                ?>
                                            </td>
                                        </tr>
                                        <?php 
                                                }
                                            } 
                                        ?> 
                                    </tbody>
                                </table>
                            </div>
                    </li>
                </ul>

                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">public</i>Idioma(s) - <?php echo $qtdIdiomas; ?></div>
                            <div class="collapsible-body white darken-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Idioma</th>
                                            <th>Nível</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if ($value["idiomas"]){
                                                foreach ($value["idiomas"] as $key => $idiomas) {    
                                                    if ($idiomas['nr_nivel'] == 1){
                                                        $nivel_idioma = "Básico";    
                                                    }else if ($idiomas['nr_nivel'] == 2){
                                                        $nivel_idioma = "Médio"; 
                                                    }else if ($idiomas['nr_nivel'] == 3){
                                                        $nivel_idioma = "Avançado"; 
                                                    }else{
                                                        $nivel_idioma = $idiomas['nr_nivel']; 
                                                    }
                                        ?>   
                                        <tr>
                                            <td><?php echo $idiomas['ds_idioma']; ?></td>
                                            <td><?php echo $nivel_idioma; ?></td>
                                            <td style="float:right;">
                                                <?php
                                                    $percent_idioma = (double) number_format(((in_percent($idiomas['cd_idioma'], $idiomas['nr_nivel'], 'cd_idioma', $idiomas_vaga)) * 100), 2, ',', ' ');

                                                    if ($percent_idioma < 33){
                                                        $estrela_idioma = 0;
                                                    }else if ($percent_idioma == 33){
                                                        $estrela_idioma = 1;
                                                    }else if ($percent_idioma > 33 && $percent_idioma <= 66){
                                                        $estrela_idioma = 3;
                                                    }else {
                                                        $estrela_idioma = 5;
                                                    }

                                                    echo '<img src="http://plataformatalent.tmp.k8.com.br/view/gui/images/estrela_small_'.$estrela_idioma.'.png" />'

                                                ?>
                                            </td>
                                        </tr>
                                        <?php 
                                                }
                                            } 
                                        ?> 
                                    </tbody>
                                </table>
                            </div>
                    </li>
                </ul>
            </div>         
        </div>

        <div class="modal-footer">
            <button onclick="imprimir(<?php echo $cd_profissional?>)" class="modal-action modal-close waves-effect waves-green btn-flat black-text"> <i class="large material-icons">print</i></button>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat black-text">Fechar</a>
        </div>
    </div>  
</td>