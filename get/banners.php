<?php 

    include '../includes/config.php';
    if(isset($_GET['id'])){
        $banners = $sdk->getBanners($_GET['id']);
    }else{
        $banners = $sdk->getBanners();
    }
    echo json_encode($banners);

?>