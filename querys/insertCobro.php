
<?php
include_once "../conexionLocal.php";
$idTM=$_POST['idTM'];
$valor=$_POST['cobro'];
$empresa=$_POST['idEmpresa'];
$semana=$_POST['semana'];

$queryIdTM="Select idTM from tm where Rut='$idTM'";
$resultado= mysql_query($queryIdTM);
$idassoc= mysql_fetch_assoc($resultado);
$idtecnologo=$idassoc['idTM'];

print_r($idtecnologo);

$queryrut="Select Rut as RutEmpresa from empresa where idEmpresa=$empresa";
$resultadorut= mysql_query($queryrut);
$Assoc= mysql_fetch_assoc($resultadorut);
$rutempresa=$Assoc['RutEmpresa'];

print_r($rutempresa);

	// comprobamos si ha ocurrido un error.
	$query = "insert into valorhora values (null,$idtecnologo,$valor,$semana,$empresa,'$rutempresa')";
	print_r($query);
	
	$resultado2 = mysql_query ( $query );
	if ($resultado2) {
		echo "Perfecto, redireccionando";
	}
	else {
		
		echo "Error en la query";
	}