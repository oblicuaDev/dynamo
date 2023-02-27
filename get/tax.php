<?php 

    include '../includes/config.php';
    $tax = $sdk->getTaxs($_GET['id']);
    echo json_encode($tax);

?>