<?php
require_once('./Controllers/controller.php');
require_once('./View/header.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    $catID = $_GET['catID'];
    echo <<<EOT
        <form form method="post" action="">
            <div class="row">
                <div class="col">
                    <label for="topicSubject">Mensaje</label>
                    <textarea class="form-control" name="replyContent" rows="3" placeholder="El mensaje no puede superar los 300 carácteres alfanuméicos"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Responder!</button>
            </div>
        </form>
        EOT;
}else{
    $errors = array(); /* array donde guardaremos los errores */

     if(!ctype_alnum($_POST['replyContent'])){
         $errors[] = 'El mensaje sólo puede contener letras y números.';
     }
        //Comprueba que no tenga una longitud superior a 300
        if(strlen($_POST['replyContent']) > 300){
            $errors[] = 'El mensaje no puede ser superior a 300 carácteres.';
        }
        if(!isset($_POST['replyContent'])){
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
        $topicID = $_GET['topicID'];
        $username = $_SESSION['username']; 
        $userIDArray = getUsrID($username);
        $userID = implode($userIDArray[0]);
        $replyContent = $_POST['replyContent'];
        $date = date('Y-m-d H:i:s');
        $data = [
            'topicID' => $topicID,
            'userID' => $userID,
            'replyContent' => $replyContent,
            'replyDate' => $date,
            ];

        insertReply($data);
        
        //Buscamos el id del topic para el botón volver
        $catID = $_GET['catID'];
        echo <<< EOT
            <div class="container" >
                <p>Tema creado con éxito.<a href="topic.php?topicID=$topicID&catID=$catID">Volver</a></p>
            </div>
            EOT;
    }
}
require_once './View/footer.php';
?>