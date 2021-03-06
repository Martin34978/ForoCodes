<?php
require_once(__DIR__ .'/../Model/model.php');

/*
    Se usa para obtener un array con las categorías
*/
function showCategories(){  
    $model = new Model();
    $conn = $model->connectionDB();
    $output = $model->queryCategories($conn);
    return $output;
}
/*
    Se usa para obtener el nombre de una categoría
    dada su ID
*/
function showCategoryName($idCat){
    $model = new Model();
    $conn = $model->connectionDB();
    $output = $model->queryCatName($conn,$idCat);
    return $output;
}
/*
    Recibe un array asociativo con la info del tema
    y ejecuta la sentencia sql para guardarlo
*/
function insertTopic($data){
    $model = new Model();
    $conn = $model->connectionDB();
    $sql = "INSERT INTO topic (topicName, catID, userID, topicDate) 
            VALUES (:topicName, :catID, :userID, :topicDate)";
    $model -> insertSQL($conn, $sql, $data);
}
/*
    Muestra el nombre de un tema dada su ID
*/
function showTopicName($topicID){
    $model = new Model();
    $conn = $model->connectionDB();
    $output = $model->queryTopicName($conn,$topicID);
    return $output;
}
/*
    Devuelve los topics de una Categoria, el ID se le pasa por GET
*/
function showTopics(){
    $model = new Model();
    $conn = $model->connectionDB();
    $output = $model->queryTopicsCatID($conn);
    return $output;
}
/*
    Se usa para buscar y mostrar el mensaje 
    que se creó al crear el tema (Oiginal Post)
*/
function showTopicOP(){
    $model = new Model();
    $conn = $model->connectionDB(); 
    $output = $model -> queryTopic($conn);
    return $output;
}
/*
    Se le pasa por parámetro el nombre de un tema
    y devuelve su ID. Se usa para el botón volver
*/
function getTopicID($topicName){
    $model = new Model();
    $conn = $model->connectionDB();
    $sql = "SELECT topicID FROM topic WHERE topicName = '$topicName'";
    $output = $model -> querySQL($conn, $sql);
    return $output;
}
/*
    Se usa para mostrar las respuestas que tiene un topic
*/
function showReplies(){
    $model = new Model();
    $conn = $model->connectionDB();
    $output = $model->queryReplies($conn);
    return $output;
}
/*
    Se usa para guardar el mensaje de respuesta a un tema.
    Recibe por parámetro un array asociativo con los valores
    necesaios para insertalos en la tabla
*/
function insertReply($data){
    $model = new Model();
    $conn = $model->connectionDB();
    $sql = "INSERT INTO reply (topicID, userID, replyContent, replyDate) 
            VALUES (:topicID, :userID, :replyContent, :replyDate)";
    $model -> insertSQL($conn, $sql, $data);
}
/* 
    Se usa al crear un nuevo usuario. Recibe un array asociativo
    y los inserta en la tabla usr.
*/
function insertUsr($data){
    $model = new Model();
    $conn = $model->connectionDB();
    $sql = "INSERT INTO usr (username, userPasswrd, userMail, userDate, userLevel) 
            VALUES (:username, :userPasswrd, :userMail, :userDate, :userLevel)";
    $model -> insertSQL($conn, $sql, $data);
}
/*
    Recibe el nombre de usuario y devuelv su ID. Se usa para guardar
    la ID del  usuario al guardar un tema o una respuesta. Toma el valor
    de $_SESSION
*/
function getUsrID($username){
    $model = new Model();
    $conn = $model->connectionDB();
    $out = $model -> queryUsrID($conn, $username);
    return $out;
}
/*
    Función que se usa al hacer login un usuario. Comprueba si username
    y password corresponden
*/
function checkUsr($username, $passwrd){
    $model = new Model();
    $userPasswrd = MD5($passwrd); //Aplicamos una funcion md5 para comparalo con el registro de la bdd
    $conn = $model->connectionDB();
    $sql = "SELECT * FROM usr WHERE username='$username' AND userPasswrd= '$userPasswrd'";
    $out = $model -> querySQL($conn, $sql);
    return $out;
}
/*
    Función que devulve el userName de un userID dado. Se usa para
    visualizar el userName en las respuestas a un tema.
*/
function getUsrName($userID){
    $model = new Model();
    $conn = $model-> connectionDB();
    $out = $model -> queryUsrName($conn, $userID);
    return $out;
}

function usernameExist($username){
    $sql = "SELECT COUNT(*) FROM usr WHERE username='$username'";
    $model = new Model();
    $conn = $model-> connectionDB();
    $out = $model -> querySQL($conn, $sql);
    $count = $out[0]["COUNT(*)"];
    if($count > 0){
        return true;
    }else{
        return false;
    }
}

function userLevel($username){
    $sql = "SELECT userLevel FROM usr WHERE username = '$username'";
    $model = new Model();
    $conn = $model-> connectionDB();
    $out = $model -> querySQL($conn, $sql);
    return $out;
}

function getLastTopic($catID){
    $sql = "SELECT topicName, topicID, topicDate, catID FROM topic WHERE catID = '$catID' ORDER BY topicDate";
    $model = new Model();
    $conn = $model-> connectionDB();
    $out = $model -> querySQL($conn, $sql);
    if($out){
    return $out;
    }else{
        echo 'No hay mensajes!';
    }
}

function searchUser($name){
    $sql = "SELECT replyContent,topicID FROM reply WHERE replyContent LIKE '%".$name."%'";
    $model = new Model();
    $conn = $model-> connectionDB();
    $out = $model -> querySQL($conn, $sql);

    return $out;

}

?> 