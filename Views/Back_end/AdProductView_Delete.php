<?php
    require_once("./Models/AdProductModel.php");

    $model = new AdProductModel();

    if (isset($_GET['masp']) && !empty($_GET['masp'])) {
        $model->deleteProduct($_GET['masp']);
    }
    
?>