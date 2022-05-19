<?php
require_once 'Model/model.php';
require_once 'Controllers/controller.php';
function getCatID(){
    $model = new Model();
    $conn = $model->connectionDB();
    $sql = "SELECT COUNT('catID') FROM category";
    $out = $model -> querySQL($conn,$sql);

    
    return $out;
}



?>