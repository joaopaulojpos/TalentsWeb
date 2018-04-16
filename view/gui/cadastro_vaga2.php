<?php
include "menu2.php";
include "foooter.php";

?>

<body class="back">

    <div class="container">
        <div class="row center">
            <h5>
                <b>Publicar uma nova vaga</b>
            </h5>
            <br/> Sua vaga e encontramos o talento certo para sua empresa !
            <br/> Sabe aquela papelada ? aquelas horas e horas conferindo linha a linha cada curriculum ?
            <br/> Você esta a um passo de acabar com isso só basta publicar a sua vaga,
            <br/> e a mágica fica por nossa conta.
        </div>

        <form>
            <div class="container">
                <div class="row">
                    <div class="input-field col s12 m12">
                        <i class="material-icons prefix">domain</i>
                        <input id="titulo" type="text" class="validate" minlength="3" required>
                        <label for="titulo">Título da vaga</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <select required>
                            <option value="" disabled selected>Selecione o Cargo</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Cargo</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <select required>
                            <option value="" disabled selected>Regime de contratação</option>
                            <option value="1">CLT</option>
                            <option value="2">PJ</option>
                            <option value="3">Freelancer</option>
                            <option value="3">Estágio</option>
                        </select>
                        <label>Contratação</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">monetization_on</i>
                        <input id="titulo" type="text" class="validate" required>
                        <label for="titulo">Salário</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">filter_1</i>
                        <input id="titulo" type="text" class="validate" required>
                        <label for="titulo">Quantidade de vagas</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <select required>
                            <option value="" disabled selected>Jornada de Trabalho</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Jornada</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <select required>
                            <option value="" disabled selected>Experiência</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Experiência</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <textarea id="textarea1" class="materialize-textarea" minlength="5" required></textarea>
                        <label for="textarea1">Benefícios</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <textarea id="textarea1" class="materialize-textarea" minlength="10" required></textarea>
                        <label for="textarea1">Descrição das atividades</label>
                    </div>

                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="input-field col s12 m9">
                        <select required>
                            <option value="" disabled selected>Escolha os cursos</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Cursos Desejado Para Vaga</label>
                    </div>

                    <div class="col s12 m2"> 
                        <input type="BUTTON" class="btn waves-effect waves-light" id="adicionar_curso" name="adicionar_curso" value="Adicionar" onclick="adicionarCurso()"/>        
                    </div>

                    <div class="input-field col s12 m9">
                        <select required>
                            <option value="" disabled selected>Competência(s) Comportamentais</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Competência(s) Comportamentais</label>
                    </div>
                    
                    <div class="col s12 m2"> 
                        <input type="BUTTON" class="btn waves-effect waves-light" id="adicionar_comport" name="adicionar_comport" value="Adicionar" onclick="adicionarComport()"/>        
                    </div>
                    
                    <div class="input-field col s12 m6">
                        <select required>
                            <option value="" disabled selected>Competência(s) Técnica(s)</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Competência(s) Técnica(s)</label>
                    </div>

                    <div class="input-field col s12 m3">
                        <select required>
                            <option value="" disabled selected>Nível</option>
                            <option value="1">Básico</option>
                            <option value="2">Médio</option>
                            <option value="3">Avançado</option>
                        </select>
                        <label>Escolha o nível</label>
                    </div>

                    <div class="col s12 m3"> 
                        <input type="BUTTON" class="btn waves-effect waves-light" id="adicionar_tecnica" name="adicionar_tecnica" value="Adicionar" onclick="adicionarTecnica()"/>        
                    </div>

                    <div class="input-field col s12 m6">
                        <select required>
                            <option value="" disabled selected>Idiomas</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Escolha os idiomas desejáveis</label>
                    </div>

                    <div class="input-field col s12 m3">
                        <select required>
                            <option value="" disabled selected>Senioridade</option>
                            <option value="1">Básico</option>
                            <option value="2">Médio</option>
                            <option value="3">Avançado</option>
                        </select>
                        <label>Escolha o nível</label>
                    </div>
                    
                    <div class="col s12 m3"> 
                        <input type="BUTTON" class="btn waves-effect waves-light" id="adicionar_idioma" name="adicionar_idioma" value="Adicionar" onclick=""/>        
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col s4 m4 offset-s2 offset-m2">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Criar
                        <i class="material-icons right">send</i>
                    </button>         
                </div>
            </div>
        </form>
    </div>

        <!-- JQUERY do Materialize -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!-- JavaScript do Materialize -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

        <!-- Materialize Compentes -->
        <script>
            $(document).ready(function () {
                $('select').material_select();
            });
        </script>
</body>
</html>