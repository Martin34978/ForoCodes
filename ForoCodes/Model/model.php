<?php
class Model{

    public function connectionDB(){
        $config = parse_ini_file('C://config.ini');
        $host = $config['host'] ;
        $dbname  = $config['dbname'];
        $username  = $config['username'];
        // FALTA PASSWORD 
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username);
 
        return $conn;
    }

    /*El parámetro $conn debe ser el PDO que devuelve connectionDB */
    public function querySQL($condition, $table, $conn){
        $sql = "SELECT $condition FROM $table";
        try {
            $search = $conn->query($sql);
            $output = $search->fetchAll(PDO::FETCH_ASSOC);       
        } catch (PDOException $e) {
            die("No se pudo conectar con $dbname :" . $e->getMessage());
        }  
        
        return $output;
        $conn->closeCursor();
        $conn = null;
        $search = null;  
    }
    
    public function insertSQL($conn, $sql, $data){
        try {
            $stm = $conn->prepare($sql);
            $stm->execute($data);
        } catch (PDOException $e) {
            die("No se pudo conectar :" . $e->getMessage());
        }
    
    //$conn->closeCursor();
    $conn = null;
    $stm = null;  

    }

    /*Tengo que mirar de refactorizar esta función con querySQL
    Ademas la estoy usando para pedir topicID a topic */
    public function queryUsr($conn, $sql){
        try {
            $search = $conn->query($sql);
            $output = $search->fetchAll(PDO::FETCH_ASSOC);       
        } catch (PDOException $e) {
            die("No se pudo conectar:" . $e->getMessage());
        }  
        
        return $output;
        $conn->closeCursor();
        $conn = null;
        $search = null; 
    }

    function queryUsrID($conn, $username){
        $sql = "SELECT userID FROM usr WHERE username='$username'";
        try {
            $search = $conn->query($sql);
            $output = $search->fetchAll(PDO::FETCH_ASSOC);       
        } catch (PDOException $e) {
            die("No se pudo conectar:" . $e->getMessage());
        }  
        
        return $output;
        $conn->closeCursor();
        $conn = null;
        $search = null; 
    }
    
    public function queryCategories($conn){
        $sql = "SELECT catID, catname, catDesc
                FROM category";
        try {
            $search = $conn->query($sql);
            $output = $search->fetchAll(PDO::FETCH_ASSOC);       
        } catch (PDOException $e) {
            die("No se pudo conectar:" . $e->getMessage());
        }  
        
        return $output;
        $conn->closeCursor();
        $conn = null;
        $search = null;
    
    }

    public function queryCatName($conn, $catID){
        $catID = $_GET['catID'];
        $sql = "SELECT catname
                FROM category
                WHERE catID = $catID";
        try {
            $search = $conn->query($sql);
            $output = $search->fetchAll(PDO::FETCH_ASSOC);       
        } catch (PDOException $e) {
            die("No se pudo conectar:" . $e->getMessage());
        }  
        
        return $output;
        $conn->closeCursor();
        $conn = null;
        $search = null;
    
    }

    public function queryTopicsCatID($conn){
        $catID = $_GET['catID'];
        $sql = "SELECT topicID, topicSubject, topicDate, topicName, userID
                FROM topic
                WHERE catID = $catID";
        try {
            $search = $conn->query($sql);
            $output = $search->fetchAll(PDO::FETCH_ASSOC);       
        } catch (PDOException $e) {
            die("No se pudo conectar:" . $e->getMessage());
        }  
        
        return $output;
        $conn->closeCursor();
        $conn = null;
        $search = null;
    
    }

    public function queryTopic($conn){
        $topicID = $_GET['topicID'];
        $sql = "SELECT topicID, topicSubject, topicDate, topicName, userID
                FROM topic
                WHERE topicID = $topicID";
        try {
            $search = $conn->query($sql);
            $output = $search->fetchAll(PDO::FETCH_ASSOC);       
        } catch (PDOException $e) {
            die("No se pudo conectar:" . $e->getMessage());
        }  
        
        return $output;
        $conn->closeCursor();
        $conn = null;
        $search = null;
    
    }

    public function queryReplies($conn){
        $topicID = $_GET['topicID'];
        $sql = "SELECT userID, replyContent, replyDate
                FROM reply
                WHERE topicID = $topicID";
        try {
            $search = $conn->query($sql);
            $output = $search->fetchAll(PDO::FETCH_ASSOC);       
        } catch (PDOException $e) {
            die("No se pudo conectar:" . $e->getMessage());
        }  
        
        return $output;
        $conn->closeCursor();
        $conn = null;
        $search = null;
    
    }

    public function queryTopicName($conn, $topicID){
        $id = $_GET['topicID'];
        $sql = "SELECT topicName
                FROM topic
                WHERE topicID = $topicID";
        try {
            $search = $conn->query($sql);
            $output = $search->fetchAll(PDO::FETCH_ASSOC);       
        } catch (PDOException $e) {
            die("No se pudo conectar:" . $e->getMessage());
        }  
        
        return $output;
        $conn->closeCursor();
        $conn = null;
        $search = null;
    
    }
}
?> 