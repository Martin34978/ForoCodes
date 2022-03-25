<?php
class Model{
    /*
    Función principal para conectarse a la BDD. Carga los parámetros de la
    conexión de un archivo situado fuera de los directorios del servidor web
    Devuelve un objeto PDO que se usará en las otras funciones para establecer
    la conexión
     */
    public function connectionDB(){
        $config = parse_ini_file('C://config.ini');
        $host = $config['host'] ;
        $dbname  = $config['dbname'];
        $username  = $config['username'];
        // FALTA PASSWORD 
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username);
 
        return $conn;
    }
    /*
    Se usa en controller.php en inserTopic(), insertReply() y insertUsr
    Guarda los datos en la BDD recibiendo por parametros una $conn que
    viene de connectionDB, en $sql la sentencia a ejecutar y $ data
    un ARRAY ASOCIATIVO cuya clave valor son las columnas y sus registros
    de la tabla
     */
    public function insertSQL($conn, $sql, $data){
        try {
            $stm = $conn->prepare($sql);
            $stm->execute($data);
        } catch (PDOException $e) {
            die("No se pudo conectar :" . $e->getMessage());
        }
    
    $conn = null;
    $stm = null;  

    }

    /*
    Hace una petición a la base de datos de la sentencia sql que recibe
    por parámetro
     */
    public function querySQL($conn, $sql){
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

    /*
    Devuelve la id de un usuario buscándolo por su username 
    */
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

    /*
    Devuelve el nombe de una Categoría buscándola por su ID
    Se usa para poner el título a la tabla cuando estamos viendo
    los temas que contiene
     */
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
    /*
     Busca y devuelve los temas que pertenezcan a la categoría que tiene
     ese id (se recibe por GET)
     */
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
    /*
    Busca los topics que tengan esa ID. El mensaje de los topics
    (topicSubject) se refiere al mensaje que publicó el que creó el
    tema. Para las respuestas se usan los que están en la tabla reply
    */
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
    /*
    Se usa para obtener las respuestas de determinado tema
    Para el post original ||MIRAR ARRIBA||
     */
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
    /*
    Recibe la ID de un tema y devulve su nombre. Se usa para poner
    el nombre del tema encima de todos los replies
     */
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

    public function queryUsrName($conn, $userID){
        $sql = "SELECT userName FROM usr WHERE userID='$userID'";
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