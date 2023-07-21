<?php

 $mysqli = new mysqli("localhost", "root", "", "dw2_f1troche");

 if (!$mysqli) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }else{
        //echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
        //echo "Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;
    }

function mostrarMensajes($mysqli){
	$sql="SELECT * FROM mensajes";
    $resultado = mysqli_query($mysqli, $sql);

    if ($resultado) {
	    return $resultado;
	}
}

function insertarMensajes($personas, $mysqli){

    $sql='INSERT INTO mensajes(fecha, usuario, email, contenido) values (current_timestamp, "'.$personas['nombre'].'","'.$personas['email'].'","'.$personas['mensaje'].'")';

    //echo($sql);
    $resp = mysqli_query($mysqli, $sql);

  	if ($resp) { header("Location: index.php"); } else { return 0; }

}

	$personas=[];
    $errores=[];
    $error=0;

	if($_POST){

		if($_POST["enviar"]){	
	    	if($_POST["nombre"]==""){
	            $error++;
	            array_push($errores,"El nombre no debe estar vacio");
	        }

	        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	            $error++;
	            array_push($errores,"El email debe ser valido");
	        }

	        if($_POST["mensaje"]==""){
	            $error++;
	            array_push($errores,"Debe cargar una fecha");
	        }

	        if ($error>0) {
	            echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'><div class='container errors' style='margin-top:50px; margin-bottom:30px; padding: 10px; border-radius: 7px; background-color: grey'><center><img src='https://cdn-icons-png.flaticon.com/512/753/753345.png' width='50px'/> <h4 style='color: white;'>Errores encontrados</h4><p style='color: white;'>";
	            $cont=count($errores);
	            for($i=0; $i<$cont; $i++){
	            	echo "<span style='text-align: left;'>".$i." ❌ ".$errores[$i]."</span><br>";
	            }
	            echo "</p></center></div>"; 
	            echo "<center><a href='index.php' class='btn btn-primary'>Volver al Inicio</a></center>";
	        }else{
	        	insertarMensajes($_POST, $mysqli);
	        }
		}else{
			header("Location: index.php");
		}

    }

function mostrarCiudades($link){
    $sql="select * from mensajes";
    $resultado = mysqli_query($link, "select * from mensajes", MYSQLI_USE_RESULT);

    if($resultado){
        printf("La selección devolvio %d filas \n", $resultado->num_rows);
        print_r($resultado);
    }

}

?>