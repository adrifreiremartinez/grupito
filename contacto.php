<?php 	$pagina = "contacto";
		$titulo = "Contacta con nosotros";
?>
<?php require_once("inc/encabezado.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("enviarMail.php"); ?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto</h1>
	  
		<?php
		
		function imprimirFormulario(){

		?>
		<form method="post" class="container">
		  <div class="form-group">
			<label for="email">Email:</label>
			<input type="text" class="form-control" id="email" name="email">
		  </div>
		  <div class="form-group">
			<label for="asunto">Asunto:</label>
			<input type="text" class="form-control" id="asunto" name="asunto">
		  </div>
		  <div class="form-group">
			<label for="mensaje">Mensaje:</label>
			<textarea class="form-control" id="mensaje" name="mensaje" rows="5"></textarea> 
		  </div>
		  <button type="submit" class="btn btn-primary" name="enviar" value="enviar">Enviar</button>
		</form>
		<?php
		}
		?>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Nuestras ofertas »</a></p>
    </div>
  </div>
  
  <?php
		
		if(!isset($_REQUEST['enviar'])){
		
		$email="";
		$asunto="";
		$mensaje="";
		
		imprimirFormulario();
	}else{
		
		$email=recoge("email");
		$asunto=recoge("asunto");
		$mensaje=recoge("mensaje");
		
		$enviar=enviarMail($email,$asunto,$mensaje);
	
		echo "Mensaje enviado correctamente";
		
		
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
  ?>
 </main>
 
 <?php require_once("inc/pie.php"); ?>