<?php
require_once('./Controllers/controller.php');
require_once('./View/header.php');

// if($_SERVER['REQUEST_METHOD'] != 'POST'){
//     echo '<form method="post" action="">
//         Mensaje: <textarea cols="30" rows="5" name="topicSubject" ></textarea>
//         <input type="submit" value="Publicar" />
//      </form>';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    $catID = $_GET['catID'];
    echo <<<EOT
        <form method="post" action="">
            <div class="row">
                <div class="col">
                    <label for="topicName">Título</label>
                    <input type="text" class="form-control" name="topicName" placeholder="Inserte título">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="topicSubject">Mensaje</label>
                    <textarea class="form-control" name="topicSubject" rows="3" placeholder="El mensaje no puede superar los 300 carácteres alfanuméicos"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Publicar!</button>
            </div>
        </form>
        EOT;
}else{
    $errors = array(); /* array donde guardaremos los errores */

     if(!ctype_alnum($_POST['topicSubject'])){
         $errors[] = 'El mensaje sólo puede contener letras y números.';
     }
    //Comprueba que no tenga una longitud superior a 300
    if(strlen($_POST['topicSubject']) > 300){
        $errors[] = 'El mensaje no puede ser superior a 300 carácteres.';
    }
    if(!isset($_POST['topicSubject'])){
        $errors[] = 'El mensaje no puede estar vacío.';
    }

    if(!empty($errors)) /*Comprueba si el array está vacio, si hubiera errores deberian estar ahí*/{
        echo 'Uh-oh.. Un par de campos no están correctamente rellenos..';
        echo '<ul>';
        foreach($errors as $key => $value) /* Recorre el array y muestra los errores */{
            echo '<li>' . $value . '</li>';
        }
        echo '</ul>';
    }else{
            /*el formulario no contiene errores
        asi que procedemos al tercer paso
        y guardamos la información*/
        $topicName = $_POST['topicName'];
        $catID = $_GET['catID'];
        $username = $_SESSION['username']; 
        $userIDArray = getUsrID($username);
        $userID = implode($userIDArray[0]);
        $topicSubject = $_POST['topicSubject'];
        $date = date('Y-m-d H:i:s');
        $data = [
            'topicName' => $topicName,
            'catID'=> $catID,
            'userID' => $userID,
            'topicSubject' => $topicSubject,
            'topicDate' => $date,
            ];

        insertTopic($data);
        
        //Buscamos el id del topic para el botón volver
        $i = getTopicID($topicName);
        $topicIDArray = $i[0];
        $topicID = $topicIDArray['topicID'];
        echo <<< EOT
            <div class="container" >
                <p>Tema creado con éxito.<a href="topic.php?topicID=$topicID&catID=$catID">Volver</a></p>
            </div>
            EOT;
    }
}
require_once './View/footer.php';
?>