<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php
function impForm($email, $password, $nombre, $apellidos, $direccion, $telefono){
?>
<form method="post">

	<div class="form-group">
		<label for="email">Email</label>
		<input type="text" class="form-control" id="email" name="email" value="<?php  echo "$email"; ?>"/>
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" name="password" value="<?php  echo "$password"; ?>"/>
	</div>
	<div class="form-group">
		<label for="nombre">Nombre</label>
		<input type="text" class="form-control" id="nombre" name="nombre" value="<?php  echo "$nombre"; ?>"/>
	</div>
	<div class="form-group">
		<label for="apellidos">Apellidos</label>
		<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php  echo "$apellidos"; ?>"/>
	</div>
	<div class="form-group">
		<label for="direccion">Direccion</label>
		<input type="text" class="form-control" id="direccion" name="direccion" value="<?php  echo "$direccion"; ?>"/>
	</div>
	<div class="form-group">
		<label for="telefono">Telefono</label>
		<input type="text" class="form-control" id="telefono" name="telefono" value="<?php  echo "$telefono"; ?>"/>
	</div>

	<button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
</form>

<?php
}
?>

<main role="main" class="container">

	<h1 class="mt-5">Insertar Nuevo Usuario</h1>
	
<?php

if(!isset($_REQUEST['guardar'])){
	
	$email="";
	$password="";
	$nombre="";
	$apellidos="";
	$direccion="";
	$telefono="";
	
	impForm($email, $password, $nombre, $apellidos, $direccion, $telefono);

}else{
	
	$email=recoge("email");
	$password=recoge("password");
	$nombre=recoge("nombre");
	$apellidos=recoge("apellidos");
	$direccion=recoge("direccion");
	$telefono=recoge("telefono");
//ME QUEDE AQUI
	$errores="";
	
	if($usuario==""){
		$errores=$errores."<li>El campo usuario no puede estar vacío</li>";
	}
	
	if($password==""){
		$errores=$errores."<li>El campo password no puede estar vacío</li>";
	}
	
	
	if($errores!=""){
		echo "<h2>ERRORES</h2> <ul>$errores</ul>";
		impForm($usuario, $password);
	}else{
		$idUsuario=insertarUsuario($usuario, $password);
		
		if($idUsuario!=0){
			echo "<div class='alert alert-success' role='alert'>
					Usuario $usuario insertado correctamente
					</div>";
			echo "<p><a href='login.php' class='btn btn-primary'>Volver al Login</a></p>";
		}else{
			echo "<div class='alert alert-danger' role='alert'>
					ERROR: Usuario NO insertado
					</div>";
			impForm($usuario, $password);
		}
		
	}
	
}


?>





<?php require_once "inc/pie.php"; ?>