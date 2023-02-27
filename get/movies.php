<?php 

    include '../includes/config.php';
    if(isset($_GET['id'])){
        $movies = $sdk->gMovies($_GET['id']);
    }else{
        $movies = $sdk->gMovies("", $_GET["propia"]);
    }
    echo json_encode($movies);

?>