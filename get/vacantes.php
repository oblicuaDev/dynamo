<?php 
header('Content-Type: application/json; charset=utf-8');
    include '../includes/config.php';
    $vacantes = $sdk->gVacantes();
    echo json_encode($vacantes);

?>