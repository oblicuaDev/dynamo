<?php 

    include '../includes/config.php';
    if(isset($_GET['id'])){
        $news = $sdk->gNews($_GET['id']);
    }else{
        $news = $sdk->gNews("", isset($_GET['filter']) ? true : false);
    }
    echo json_encode($news);

?>