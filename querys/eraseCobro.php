<?php
include_once "../conexionLocal.php";


$idTM=$_POST['id'];
$valor=$_POST['valor'];
$empresa=$_POST['empresa'];
$semana=$_POST['semana'];

$queryId="Select idEmpresa from empresa where Nombre='$empresa'";
$resultadoId= mysql_query($queryId);
$Assoc= mysql_fetch_assoc($resultadoId);
$idEmpresa=$Assoc['idEmpresa'];

if($semana=="Semana"){
$query="Delete from valorhora WHERE TM_idTM=$idTM and Empresa_idEMpresa=$idEmpresa and Semana=1 ";
}
else {
$query="Delete from valorhora WHERE TM_idTM=$idTM and Empresa_idEMpresa=$idEmpresa and Semana=0";	
}



$resultadoborrar=mysql_query($query);
if($resultadoborrar) {
	//success
	echo"Borrado con exito";
	
} else { 
    //failure
    echo "Error en la eliminacion";
   
}   

