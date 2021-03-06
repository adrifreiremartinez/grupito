<?php session_start(); ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>

<?php

	$pagina="index";
	$titulo="Grupito";

?>

<?php require_once "inc/encabezado.php"; ?>

<?php

function imprimirFormulario($usuario, $password){
	
?>

<form>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="text" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary" name="entrar" value="entrar">Entrar</button>
  <a href="insertarUsuario.php" class="btn btn-danger">Nuevo Usuario</a>
</form>

<?php
}//Final imprimiFormulario
?>

<main role="main" class="container">

	<h1 class="mt-5">Acceso</h1>

<?php

if(!isset($_REQUEST['entrar'])){
		
		$email="";
		$password="";
		
		imprimirFormulario($email,$password);
	}else{
		
		$email=recoge("email");
		$password=recoge("password");
		
		
		$user=seleccionarUsuario($email);
		
		$ok=password_verify($password, $user['password']);
		
		if (!$ok){
			
			echo "<div class='alert alert-danger' role='alert'>
					El usuario o la contraseña son incorrectos
					</div>";
			imprimirFormulario($email,$password);
		}else{
			
			$_SESSION['email']=$email;
			header("Location: usuarios.php");
		}
	}
?>

</main>
<?php require_once "inc/pie.php"; ?>
