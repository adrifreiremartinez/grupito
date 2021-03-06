<?php include "configuracion.php"; ?>



<?php
//Funcion para conectarnos a la base de datos
function conectarBD(){
	try{
		$con = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", USER, PASS);
		
		$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "Error: Error al conectar la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $con;
}
 
//Funcion para desconectar BD

function desconectarBD($con){
	$con = NULL;
	return $con;
}

//Funcion para seleccionar ofertas portada


function seleccionarOfertasPortada($numOfertas){
	
	$con = conectarBD();
	
	try{
		
		$sql= "SELECT * FROM productos LIMIT :numOfertas";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':numOfertas',$numOfertas, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar productos: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
	
}

//Funcion para insertar producto

function insertarProd($idProducto, $nombre, $introDescripcion, $descripcion, $imagen, $precio, $precioOferta, $online){
	
	$con = conectarBD();
	
	try{
		
		$sql = "INSERT INTO productos (nombre, introDescripcion, descripcion, imagen, precio, precioOferta, online) VALUES (:nombre, :introDescripcion, :descripcion, :imagen, :precio, :precioOferta, :online)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':introDescripcion', $introDescripcion);
		$stmt->bindParam(':descripcion', $descripcion);
		$stmt->bindParam(':imagen', $imagen);
		$stmt->bindParam(':precio', $precio);
		$stmt->bindParam(':precioOferta', $precioOferta);
		$stmt->bindParam(':online', $online);

		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al insertar producto: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $con->lastInsertId();
}

//Funcion seleccionar todos los productos

function seleccionarTodosProd(){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM productos";
		
		$stmt = $con->query($sql);
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar todos los productos: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
	
}

//Seleccionar producto




function seleccionarProducto($idProducto){

	$con = conectarBD();

	try{
		
		$sql = "SELECT * FROM productos WHERE idProducto= :idProducto";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
		$stmt->execute();	

		$row = $stmt -> fetch(PDO::FETCH_ASSOC);

	}catch(PDOException $e){
		
		echo "Error: Error al seleccionar una oferta: ".$e->getMessage();

		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		
		exit;

	}





	return $row;


}

//Seleccionar productos por pagina
function seleccionarProds($inicio, $prodPagina){
	
	$con = conectarBD();
		
		try{
			
			$sql = "SELECT * FROM productos LIMIT :inicio , :prodPagina";
			
			$stmt = $con->prepare($sql);
			
			$stmt->bindParam (':inicio', $inicio, PDO::PARAM_INT);//Cuando necesito un valor entero le paso el PDO::PARAM_INT
			$stmt->bindParam (':prodPagina', $prodPagina, PDO::PARAM_INT);
			
			$stmt->execute();
			
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){
			echo "Error: Error al seleccionar todos los productos: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
			exit;
		}
		
		return $rows;
	
}


//Seleccionar usuario
function seleccionarUsuario($email){
	
	$con = conectarBD();
	
	try{
		
		$sql="SELECT * FROM usuarios WHERE email=:email";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam (':email', $email);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: El usuario o la contraseña son incorrectos ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $row;
}



//Funcion seleccionar todos los usuarios

function seleccionarTodosUsu(){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM usuarios";
		
		$stmt = $con->query($sql);
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar todos los usuarios: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
	
}

//Seleccionar usuarios por pagina
function seleccionarUsus($inicio, $usuPagina){
	
	$con = conectarBD();
		
		try{
			
			$sql = "SELECT * FROM usuarios LIMIT :inicio , :usuPagina";
			
			$stmt = $con->prepare($sql);
			
			$stmt->bindParam (':inicio', $inicio, PDO::PARAM_INT);//Cuando necesito un valor entero le paso el PDO::PARAM_INT
			$stmt->bindParam (':usuPagina', $usuPagina, PDO::PARAM_INT);
			
			$stmt->execute();
			
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){
			echo "Error: Error al seleccionar todos los usuarios: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
			exit;
		}
		
		return $rows;
	
}

//Funcion para insertar usuario


function insertarUsuario($idUsuario, $email, $password, $nombre, $apellidos, $direccion, $telefono){
	
	$con = conectarBD();
	$password = password_hash($password,PASSWORD_DEFAULT);
	
	try{
		
		$sql = "INSERT INTO usuarios (idUsuario, email, password, nombre, apellidos, direccion, telefono) VALUES (:idUsuario, :email, :password, :nombre, :apellidos, :direccion, :telefono)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUsuario', $idUsuario);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':apellidos', $apellidos);
		$stmt->bindParam(':direccion', $direccion);
		$stmt->bindParam(':telefono', $telefono);

		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al insertar usuario: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}






//Funcion para insertar pedido


function insertarPedido($idUsuario, $detallePedido, $total){
	
	$con = conectarBD();
	
	try{
		
		$con -> beginTransaction();
		
		$sql = "INSERT INTO pedidos (idUsuario, total) VALUES (:idUsuario, :total)";
		$stmt = $con->prepare($sql);
		
		$stmt = bindparam(":idUsuario", $idUsuario);
		$stmt = bindparam(":total", $total);
		
		$stmt->execute();
		
		$idPedido = $con->lastInsertId();
		
		foreach ($detallePedido as $idProducto => $cantidad){
			
			$producto = seleccionarProducto($idProducto);
			$precio = $producto['precioOferta'];
			
			$sql2 = "INSERT INTO detallePedido (idPedido, idProducto, cantidad, precio) VALUES (:idPedido, :idProducto, :cantidad, :precio)";
			
			$stmt = $con->prepare($sql2);
		
			$stmt = bindparam(":idPedido", $idPedido);
			$stmt = bindparam(":idProducto", $idProducto);
			$stmt = bindparam(":cantidad", $cantidad);
			$stmt = bindparam(":precio", $precio);
			
			$stmt->execute();
			
		}
		
		$con -> commit();
		
	}catch(PDOException $e){
		
		$con -> rollback();
		
		echo "Error: Error al insertar pedido: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	
return $idPedido;
	
}





































?>