<?php session_start(); ?>

<?php

$pagina="carrito";
$titulo="Tu compra";

?>

<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php require_once("inc/encabezado.php"); ?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Tu carrito de la compra</h1>
      <p><a class="btn btn-primary btn-lg" href="index.php" role="button">Seguir comprando »</a></p>
    </div>
  </div>

	<?php
	
		if(empty($_SESSION['carrito'])){
			$mensaje = "CARRITO VACÍO";
			
			mostrarMensaje($mensaje);
	
		}else{
	
	?>

	<div class="container">
	
		<?php
		
			
		
		?>
		
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
      <th scope="col">Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php
		
		$total=0;
		
		foreach($_SESSION['carrito'] as $id => $cantidad){
			
			$producto = seleccionarProducto($id);
			
			$nombre = $producto['nombre'];
			$precio = $producto['precioOferta'];
			$subtotal = $precio*$cantidad;
			$total=$total+$subtotal;
	?>
	
		<tr>
      <td scope="col"><a class="badge badge-pill badge-dark" href="producto.php?id=<?php echo $producto['idProducto']; ?>" ><?php echo $nombre; ?></a></td>
      <td scope="col"><a href ="procesarCarrito.php?id=<?php echo $id; ?>&op=remove"><i class="fas fa-minus-circle fa-lg"></i></a> <?php echo $cantidad; ?> <a href ="procesarCarrito.php?id=<?php echo $id; ?>&op=add"><i class="fas fa-plus-circle fa-lg"></i></a></td>
      <td scope="col"><?php echo $precio; ?></td>
      <td scope="col"><?php echo $subtotal; ?></th>
    </tr>
	
	<?php
		} //Fin foreach
	?>
  </tbody>
  <tfoot>
	<tr>
		<th scope="row" colspan="3">TOTAL</th>
		<th>
			<?php echo $total; ?>
		</th>
	</tr>
  </tfoot>
</table>

	<a href="procesarCarrito.php?id=<?php echo $id; ?>&op=empty" class="btn btn-danger">Vaciar Carrito</a>
	<a href="confirmarPedido.php" class="btn btn-success">Confirmar Pedido</a>
	
</div>

<?php

	$_SESSION['total']=$total;

?>


<?php
		} //Fin del else de la funcion de mostrarMensaje
?>
</main>













<?php require_once("inc/pie.php"); ?>