
<?php
include_once "../conexionLocal.php";
$nombre = $_POST ['nombre'];
$apellido = $_POST ['apellido'];
$rut = $_POST ['rut'];
$mail = $_POST ['mail'];
$celular = $_POST ['celular'];
$contraseņa = $_POST ['contrasena'];
$repetircontraseņa = $_POST ['repetircontrasena'];

if ($contraseņa == $repetircontraseņa) {
	// comprobamos si ha ocurrido un error.
	$query = "insert into TM values (null,'$nombre','$apellido','$rut','$mail','$celular','$contraseņa',0)";
	$resultado2 = mysql_query ( $query );
	if ($resultado2) {
		echo "Perfecto, redireccionando";
		?>

<meta http-equiv="Refresh" content="1;url=../agregarTmR.php">
<?php
	} else {
		echo "Error el rut ya existe, intente denuevo";
		?>

<meta http-equiv="Refresh" content="1;url=../agregarTmR.php">
<?php
	}
} else {
	echo " Las contraseņas no coinciden, redireccionando";
	?>
<meta http-equiv="Refresh" content="1;url=../agregarTmR.php">
; 
    <?php
}

?>
    