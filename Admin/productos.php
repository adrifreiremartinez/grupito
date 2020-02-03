<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<main role="main" class="container">

	<h1 class="mt-5">Listado de productos</h1>
	
<?php

$prod = seleccionarTodosProd();

$numProd = count($prod);

$prodPagina = 2;

$paginas = ceil($numProd / $prodPagina);

$pagina = (int)recoge("pagina"); //Saber en que pagina esto

	if($pagina==FALSE or $pagina<=0 or $pagina>$paginas){
				
		$pagina=1;

	}
	
$inicio = ($pagina-1)* $prodPagina;

$prod = seleccionarProds($inicio, $prodPagina);

?>

<table class="table table-striped">

	<thead>
		<tr>
		  <th scope="col">idProducto</th>
		  <th scope="col">Nombre</th>
		  <th scope="col">Introducción</th>
		  <th scope="col">Descripción</th>
		  <th scope="col">Precio</th>
		  <th scope="col">Oferta</th>
		  <th scope="col">Imagen</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		foreach ($prod as $producto){
			$idProducto = $producto['idProducto'];
			$nombre = $producto['nombre'];
			$introDescripcion = $producto['introDescripcion'];
			$descripcion = $producto['descripcion'];
			$precio = $producto['precio'];
			$precioOferta = $producto['precioOferta'];
			$imagen = $producto['imagen'];			
		?>
		
		<tr>
		  <th scope="row"><?php  echo $idProducto; ?></th>
		  <td><?php  echo $nombre; ?></td>
		  <td><?php  echo $introDescripcion; ?></td>
		  <td><?php  echo $descripcion; ?></td>
		  <td><?php  echo $precio; ?></td>
		  <td><?php  echo $precioOferta; ?></td>
		  <td><img src="img/<?php  echo $imagen; ?> "></td>
		
		<?php
		}//Fin foreach prods
		?>
		
	</tbody>
	
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php if ($pagina==1){ echo "disabled"; }?>"><a class="page-link" href="productos.php?pagina=<?php  echo $pagina-1; ?>">Anterior</a></li>
	
	<?php
	for ($i=1; $i<=$paginas; $i++){
    
	?>
	
	<li class='page-item <?php if ($pagina==$i){ echo "active"; }?>'><a class='page-link' href='productos.php?pagina=<?php  echo $i ?>'><?php  echo $i; ?></a></li>
    
	
	<?php
	}
	?>
	<li class="page-item <?php if ($pagina==$paginas){ echo "disabled"; }?>"><a class="page-link" href="productos.php?pagina=<?php  echo $pagina+1; ?>">Siguiente</a></li>
  </ul>
</nav>


</main>

<?php require_once "inc/pie.php"; ?>