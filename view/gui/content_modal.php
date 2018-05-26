    <!-- ARQUIVO DO PROFISSIONAL DO PROFISSIONAL (MODAL) -->

    <!-- LAYOUT DOS CANDIDATOS APTOS -->

<td>
    <div id="modal<?php echo $cd_profissional?>" class="modal modal-fixed-footer teal darken-2">
        <div class="modal-content">
            <div class="row">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="<?php echo $b_foto; ?>" align="left" width="150" height="150">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if ($value["competencias_tecnicas"]){
                                                foreach ($value["competencias_tecnicas"] as $key => $idiomas) {              
                                            ?>   
                                        <tr>
                                            <td><?php echo $idiomas['ds_competencia_tecnica']; ?></td>
                                            <td><?php echo $idiomas['nr_nivel']; ?></td>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if ($value["idiomas"]){
                                                foreach ($value["idiomas"] as $key => $idiomas) {              
                                        ?>   
                                        <tr>
                                            <td><?php echo $idiomas['ds_idioma']; ?></td>
                                            <td><?php echo $idiomas['nr_nivel']; ?></td>
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
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
        </div>
    </div>  
</td>