<?php
require_once(__DIR__ .'/../Model/model.php');

    function showCategories(){  
        $model = new Model();
        $conn = $model->connectionDB();
        $output = $model->queryCategories($conn);
        return $output;
    }

    function showCategoryName($idCat){
        $model = new Model();
        $conn = $model->connectionDB();
        $output = $model->queryCatName($conn,$idCat);
        return $output;
    }

    function insertTopic($data){
        $model = new Model();
        $conn = $model->connectionDB();
        $sql = "INSERT INTO topic (topicName, catID, userID, topicSubject, topicDate) 
                VALUES (:topicName, :catID, :userID, :topicSubject, :topicDate)";
        $model -> insertSQL($conn, $sql, $data);
    }

    function showTopicName($topicID){
        $model = new Model();
        $conn = $model->connectionDB();
        $output = $model->queryTopicName($conn,$topicID);
        return $output;
    }
    // Devuelve los topics de una Categoria, el ID se le pasa por GET
    function showTopics(){
        $model = new Model();
        $conn = $model->connectionDB();
        $output = $model->queryTopicsCatID($conn);
        return $output;
    }

    function showTopicOP(){
        $model = new Model();
        $conn = $model->connectionDB(); 
        $output = $model -> queryTopic($conn);
        return $output;
    }

    function getTopicID($topicName){
        $model = new Model();
        $conn = $model->connectionDB();
        $sql = "SELECT topicID FROM topic WHERE topicName = '$topicName'";
        $output = $model -> queryUsr($conn, $sql);
        return $output;
    }

    function showReplies(){
        $model = new Model();
        $conn = $model->connectionDB();
        $output = $model->queryReplies($conn);
        return $output;
    }

    function insertReply($data){
        $model = new Model();
        $conn = $model->connectionDB();
        $sql = "INSERT INTO reply (topicID, userID, replyContent, replyDate) 
                VALUES (:topicID, :userID, :replyContent, :replyDate)";
        $model -> insertSQL($conn, $sql, $data);
    }
            /* RELACIONADAS CON USER */
    function insertUsr($data){
        $model = new Model();
        $conn = $model->connectionDB();
        $sql = "INSERT INTO usr (username, userPasswrd, userMail, userDate, userLevel) 
                VALUES (:username, :userPasswrd, :userMail, :userDate, :userLevel)";
        $model -> insertSQL($conn, $sql, $data);
    }

    function getUsrID($username){
        $model = new Model();
        $conn = $model->connectionDB();
        $out = $model -> queryUsrID($conn, $username);
        return $out;
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