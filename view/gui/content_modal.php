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