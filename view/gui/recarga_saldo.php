<?php
include "menu.php";

  if (!isset($_SESSION['empresaLogada'])) {   //Verifica se há seções
    session_destroy();            //Destroi a seção por segurança
    header("Location: login.php"); 
    exit; //Redireciona o visitante para login
  }

  $empresa = $_SESSION['empresaLogada']; 

?>
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