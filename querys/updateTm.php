<?php
include_once "../conexionLocal.php";

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$rut=$_POST['rut'];
$mail=$_POST['mail'];
$celular=$_POST['celular'];

$query="UPDATE TM SET Nombre='$nombre', Apellido='$apellido', Rut=$rut, Mail='$mail', Celular=$celular WHERE Rut=$rut";

$resultado=mysql_query($query);
if($resultado) {
	//success
	echo"Actualizado con exito, redireccionando";
	
} else { 
    //failure
    echo " Se produjo un error en la actualizacion, redireccionando";
   
}   

