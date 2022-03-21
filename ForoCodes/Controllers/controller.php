<?php
require_once(__DIR__ .'/../Model/model.php');

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

    function insertUsr($data){
        $model = new Model();
        $conn = $model->connectionDB();
        $sql = "INSERT INTO usr (username, userPasswrd, userMail, userDate, userLevel) 
                VALUES (:username, :userPasswrd, :userMail, :userDate, :userLevel)";
        $model -> insertSQL($conn, $sql, $data);
    }

    function checkUsr($username, $userPasswrd){
        $model = new Model();
        //$passwrd = md5($userPasswrd); //Aplicamos una funcion md5 para comparalo con el registro de la bdd
        $conn = $model->connectionDB();
        $sql = "SELECT * FROM usr WHERE username='$username' AND userPasswrd= '$userPasswrd'";
        $out = $model -> queryUsr($conn, $sql);
        return $out;

    }

?> 