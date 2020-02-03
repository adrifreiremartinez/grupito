<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<main role="main" class="container">

	<h1 class="mt-5">Listado de Usuarios</h1>
	
	
	<p><a href="insertarUsuario.php" class="btn btn-success">Nuevo Usuario</a></p>
<?php

$usuarios = seleccionarTodosUsu();

$numUsu = count($usuarios);

$usuPagina = 2;

$paginas = ceil($numUsu / $usuPagina);

$pagina = (int)recoge("pagina"); //Saber en que pagina estoy

	if($pagina==FALSE or $pagina<=0 or $pagina>$paginas){
				
		$pagina=1;

	}
	
$inicio = ($pagina-1)* $usuPagina;

$usuarios = seleccionarUsus($inicio, $usuPagina);

?>

<table class="table table-striped">

	<thead>
		<tr>
		  <th scope="col">idUsuario</th>
		  <th scope="col">Email</th>
		  <th scope="col">Password</th>
		  <th scope="col">Nombre</th>
		  <th scope="col">Apellidos</th>
		  <th scope="col">Dirección</th>
		  <th scope="col">Teléfono</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		foreach ($usuarios as $usu){
			$idUsuario = $usu['idUsuario'];
			$email = $usu['email'];
			$password = $usu['password'];
			$nombre = $usu['nombre'];
			$apellidos = $usu['apellidos'];
			$direccion = $usu['direccion'];
			$telefono = $usu['telefono'];			
		?>
		
		<tr>
		  <th scope="row"><?php  echo $idUsuario; ?></th>
		  <td><?php  echo $email; ?></td>
		  <td><?php  echo $password; ?></td>
		  <td><?php  echo $nombre; ?></td>
		  <td><?php  echo $apellidos; ?></td>
		  <td><?php  echo $direccion; ?></td>
		  <td><?php  echo $telefono; ?></td>
		
		<?php
		}//Fin foreach usuarios
		?>
		
	</tbody>
	
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php if ($pagina==1){ echo "disabled"; }?>"><a class="page-link" href="usuarios.php?pagina=<?php  echo $pagina-1; ?>">Anterior</a></li>
	
	<?php
	for ($i=1; $i<=$paginas; $i++){
    
	?>
	
	<li class='page-item <?php if ($pagina==$i){ echo "active"; }?>'><a class='page-link' href='usuarios.php?pagina=<?php  echo $i ?>'><?php  echo $i; ?></a></li>
    
	
	<?php
	}
	?>
	<li class="page-item <?php if ($pagina==$paginas){ echo "disabled"; }?>"><a class="page-link" href="usuarios.php?pagina=<?php  echo $pagina+1; ?>">Siguiente</a></li>
  </ul>
</nav>


</main>

<?php require_once "inc/pie.php"; ?>