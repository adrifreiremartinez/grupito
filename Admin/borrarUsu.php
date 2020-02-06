<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>
<main role="main" class="container">

	<h1 class="mt-5">Borrar Usuario</h1>

	<?php
	
		$idUsuario=recoge('idUsuario');
	
		if($idUsuario==""){
			header("Location: usuarios.php");
			exit();
		}
		
		$ok=borrarUsuario ($idUsuario);
		
		if($ok!=0){
				echo "<div class='alert alert-success' role='alert'>
						Usuario $idUsuario borrado correctamente
						</div>";
			}else{
				echo "<div class='alert alert-danger' role='alert'>
						ERROR: Usuario $idUsuario NO borrado
						</div>";
			}
			echo "<p><a href='index.php' class='btn btn-primary'>Volver al listado</a></p>";
	?>

</main>
<?php require_once "inc/pie.php"; ?>