<?php

/*
 * Funcion recibe los datos de un evento para ingresarlo en la base de datos, retorna
 * 1 si success o 0 si fail
 */
require_once dirname(__FILE__).'/../conexionLocal.php';
function insertEvento($idTM, $idEco, $start, $end){
    $newStart = explode('T', $start);
    $newEnd = explode('T', $end);
    $newStart = $newStart[0].' '.$newStart[1];
    $newEnd = $newEnd[0].' '.$newEnd[1];

    $query = "INSERT INTO evento (TM_idTM, Ecos_idEcos, HoraInicio, HoraTermino) VALUES ($idTM,$idEco,'$newStart', '$newEnd')";
    $result = mysql_query($query);
    if($result){
        return 1;
    }
    else{
        return $query;
    }

}
?>