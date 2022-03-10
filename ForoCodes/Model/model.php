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
}


?> 