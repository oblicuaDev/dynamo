<?php 

    include '../includes/config.php';
    $series = $sdk->gSeries();
    if(isset($_GET['id'])){
        $temporadas = $sdk->gTemporadas($_GET['id']);
    }else{
        $temporadas = $sdk->gTemporadas("", $_GET["propia"]);
    }
    $array = array();
    $array["temporadas"] = $temporadas;
    $array["series"] = $series;

    echo json_encode($array);

?>