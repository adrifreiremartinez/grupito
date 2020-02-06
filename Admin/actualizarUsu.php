<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php
function imprimirFormulario($email){
?>

<form method="post">
	<div class="form-group">
		<label for="email">EMAIL</label>
		<input type="text" class="form-control" id="email" name="email" value="<?php  echo "$email"; ?>" readonly="readonly" />
	</div>
	<div class="form-group">
		<label for="password">PASSWORD ACTUAL</label>
		<input type="password" class="form-control" id="password" name="password" />
	</div>
	<div class="form-group">
		<label for="password1">NUEVA PASSWORD</label>
		<input type="password" class="form-control" id="password1" name="password1" />
	</div>
	<div class="form-group">
		<label for="password2">REPETIR NUEVA PASSWORD</label>
		<input type="password" class="form-control" id="password2" name="password2" />
	</div>
	<div class="form-group">
		<label for="nomre">NOMBRE</label>
		<input type="text" class="form-control" id="nombre" name="nombre" value="<?php  echo "$nombre"; ?>" />
	</div>
	<div class="form-group">
		<label for="apellidos">APELLIDOS</label>
		<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php  echo "$apellidos"; ?>" />
	</div>
	<div class="form-group">
		<label for="direccion">DIRECCIÓN</label>
		<input type="text" class="form-control" id="direccion" name="direccion" />
	</div>
	<div class="form-group">
		<label for="telefono">TELÉFONO</label>
		<input type="text" class="form-control" id="telefono" name="telefono" />
	</div>
	
	<button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
<?php
}//Fin funcion imprimirFormulario
?>
<main role="main" class="container">

	<h1 class="mt-5">Actualizar Usuario</h1>
	
</main>
<?php

	if(!isset($_REQUEST['guardar'])){
		
		$email = recoge("email");
		
		if($email==""){//Aqui utilizo comillas vacias porque lo que devuelve es una cadena de texto
			header("Location: usuarios.php");
			exit();
		}
		
		$user = seleccionarUsuario($email);
		
		if(empty($user)){//Utilizo empty porque tengo que ver si el array viene vacio
				header("Location: usuarios.php");
			exit();//Tambien se puede poner die();
		}
		
			$email = $user['email'];
			
			imprimirFormulario($email);
	}else{
		
		$email=recoge("email");
		$password=recoge("password");
		$password1=recoge("password1");
		$password2=recoge("password2");
		$nombre=recoge("nombre");
		$apellidos=recoge("apellidos");
		$direccion=recoge("direccion");
		$telefono=recoge("telefono");
		
		$errores="";
		
		if($nombre==""){
			$errores=$errores."<li>El campo  nombre no puede estar vacío</li>";
		}
		
		if($apellidos==""){
			$errores=$errores."<li>El campo  apellidos no puede estar vacío</li>";
		}
		
		if($direccion==""){
			$errores=$errores."<li>El campo  dirección no puede estar vacío</li>";
		}
		
		if($telefono==""){
			$errores=$errores."<li>El campo  teléfono no puede estar vacío</li>";
		}
		
		if($password==""){
			$errores=$errores."<li>El campo PASSWORD ACTUAL no puede estar vacío</li>";
		}
		
		if($password1==""){
			$errores=$errores."<li>El campo NUEVA PASSWORD no puede estar vacío</li>";
		}
		
		if($password1!=$password2){
			$errores=$errores."<li>La PASSWORD NUEVA no coincide</li>";
		}
		
		$usuPass=seleccionarUsuario($email);
		
		$coinciden=password_verify($password, $usuPass['password']);
		
		if(!$coinciden){
			$errores=$errores."<li>La PASSWORD  no es igual a la anterior</li>";
		}
		
		if($errores!=""){
			echo "<h2>Errores</h2> <ul>$errores</ul>";
			imprimirFormulario($email);
		}else{
			$user=actualizarUsuario($usuario, $password1);
			
			
			if($user){
				echo "<div class='alert alert-success' role='alert'>
						Usuario $email actualizado correctamente
						</div>";
//Me quede aqui, falta hacer la funcion en la bbdd para actualizarUsu
				echo "<p><a href='indexUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
			}else{
				echo "<div class='alert alert-danger' role='alert'>
						ERROR: Usuario NO actualizado
						</div>";
				imprimirFormulario($usuario);
			}
		}
	}
?>

<?php require_once "inc/pie.php"; ?