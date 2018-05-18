<?php
include "menu.php";

  if (!isset($_SESSION['empresaLogada'])) {   //Verifica se h� se��es
    session_destroy();            //Destroi a se��o por seguran�a
    header("Location: login.php"); 
    exit; //Redireciona o visitante para login
  }

  $empresa = $_SESSION['empresaLogada']; 

?>
  <div class="row">
    <div class="col s12 m12">    
      <?//php echo $empresa[0]['ds_razao_social'] ?>
      <div class="section right-align">
        <a href="dashboard.php" class="waves-effect waves-light btn"><i class="material-icons left">chevron_left</i>Voltar</a>
      </div>
    </div>
  </div>
	
	<div class='container gray darken-2'>
		<div class="row">
			<h2>Pagamento</h2>
			<p>Recarregue o saldo da sua empresa, para continuar postando vagas!</p>
		</div>
		<div class="row">
			<h6>Selecione a quantidade que deseja recarregar</h6>
			<p>
				<label>
				<input class="with-gap" name="group3" type="radio" checked />
				<span>Red</span>
				</label>
		    </p>
        
		</div>
	</div>

<?php

include "foooter.php";

?>