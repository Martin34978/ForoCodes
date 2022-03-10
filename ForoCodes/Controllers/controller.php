<?php
require_once('../Model/model.php');

    function showCategories(){  
        $model = new Model();
        $conn = $model->connectionDB();
        $condition= '*';
        $table = 'Category';
        $output = $model->querySQL($condition, $table, $conn);
        print_r($output);
    }

    function showTopics(){
        $model = new Model();
        $conn = $model->connectionDB();
        $condition= '*';
        $table = 'Topic';
        $output = $model->querySQL($condition, $table, $conn);
        print_r($output);
    }

?> 