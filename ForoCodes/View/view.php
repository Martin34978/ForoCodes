
<?php
require_once('./Controllers/controller.php');

/*              Alerta Cookies
El botón envia por GET cookies-policy y por tanto
entra en el if que crea la cookie y evitando entrar
en el if que muestra el cartel                    */

function cookiesPolicy(){
    if(isset($_REQUEST['cookies-policy'])) {
        $time = time() + (60 * 60 * 24 * 7);
        setcookie('policy', '1', $time, '/', NULL, TRUE, TRUE);
    }
    if (!isset($_REQUEST['cookies-policy']) && !isset($_COOKIE['policy'])){
    echo <<<EOT
    <div class="d-flex justify-content-center container mt-5">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex flex-row justify-content-between align-items-center card cookie p-3">
                    <div class="d-flex flex-row align-items-center"><img src="https://i.imgur.com/Tl8ZBUe.png" width="40">
                        <div class="ml-2 mr-2"><span>Si triste es perdir, mas triste es robar.<br>Usamos cookies para el funcionamiento de la web.<br> Estas cookies
                         son estrictamente funcionales y novendemos datos a terceros.<br></span><a class="learn-more" href="https://www.iglesia.net/biblia/libros/apocalipsis.html">Leer la biblia<i class="fa fa-angle-right ml-2"></i></a></div>
                    </div> 
                    <div><a href="?cookies-policy=1" class="btn btn-dark" type="button">Aceptar</a></div>
                </div>
            </div>
        </div>
    </div>
    EOT;
}
}

function login(){
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        /*
        Si el formulario no ha sido enviado, muestraló
        */
        echo '<div >';
        echo '<h2>Iniciar Sesión:</h2>';
        echo '<form method="post" action="">
            Username: <input type="text" name="user_name" />
            Password: <input type="password" name="user_pass">
            <input type="submit" value="Ingresar" />
         </form>';
         echo '</div>';
    }
    else{
        $errors = array(); /* array donde guardaremos los errores */
         
        if(isset($_POST['user_name'])){
            //Comprueban que sean carácteres alfanuméricos
                        //añadir comprobacion de usuario existente
            if(!ctype_alnum($_POST['user_name'])){
                $errors[] = 'El nombre de usuario sólo puede contener letras y números.';
            }
            //Comprueba que no tenga una longitud superior a 30
            if(strlen($_POST['user_name']) > 30){
                $errors[] = 'El nombre de usuario no puede ser superior a 30 carácteres.';
            }
        }
        else{
            $errors[] = 'El nombre de usuario no puede estar vacío.';
        }
    
        if(isset($_POST['user_pass'])){   //Comprobamos que las dos pass son iguales
            if($_POST['user_pass']){
                //Definir mas validaciones
            }else{
                $errors[] = 'La contraseña no puede estar vacía.';
            }
        }
        else{
          
        }
        if(!empty($errors)) /*Comprueba si el array está vacio, si hubiera errores deberian estar ahí*/{
            echo 'Uh-oh.. Un par de campos no están correctamente rellenos..';
            echo '<ul>';
            foreach($errors as $key => $value) /* Recorre el array y muestra los errores */{
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>';
        }else{
            $username = $_POST['user_name'];
            $passwrd = $_POST['user_pass'];
            //$userPasswrd = md5($passwrd);
            $check = checkUsr($username, $passwrd);
            if($check){
                $_SESSION['login'] = 'true';
                $_SESSION['userLevel'] = userLevel($username);
                $_SESSION['username'] = "$username";
                header('Location: index.php');
            }else{
                echo "El nombre de usuario o la contraseña no son correctos";
            }
        }
    }
}
function signUp(){
    echo '<h3>Registro</h3>';

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        /*Si el formulario no ha sido enviado, muestralo
          el acntio="" deberia redirigir a la misma página */
        echo '<form method="post" action="">
            Username: <input type="text" name="user_name" />
            Password: <input type="password" name="user_pass">
            Password again: <input type="password" name="user_pass_check">
            E-mail: <input type="email" name="user_email">
            <input type="submit" value="Registrarse" />
         </form>';
    }
    else{
        /* Si el formulario ha sido enviado, lo procesamos en 3 pasos
            1.  Comprueba la información
            2.  Deja al usuario corregir la información(si es necesario)
            3.  guarda la información
        */
        $errors = array(); /* array donde guardaremos los errores */
         
        if(isset($_POST['user_name'])){
            $username = $_POST['user_name'];
            $alreadyExist = usernameExist($username);

            //Comprueba si existe un usuario con el mismo nombre 
            if($alreadyExist){
                var_dump($alreadyExist);
                $errors[] = 'El nombre de usuario ya existe';
            }
            //Comprueban que sean carácteres alfanuméricos
            if(!ctype_alnum($_POST['user_name'])){
                $errors[] = 'El nombre de usuario sólo puede contener letras y números.';
            }
            //Comprueba que no tenga una longitud superior a 30
            if(strlen($_POST['user_name']) > 30){
                $errors[] = 'El nombre de usuario no puede ser superior a 30 carácteres.';
            }
        }
        else{
            $errors[] = 'El nombre de usuario no puede estar vacío.';
        }
         
         
        if(isset($_POST['user_pass'])){   //Comprobamos que las dos pass son iguales
            if($_POST['user_pass'] != $_POST['user_pass_check']){
                $errors[] = 'Las dos contraseñas no coinciden.';
            }
        }
        else{
            $errors[] = 'El contraseña no puede estar vacía.';
        }
         
        if(!empty($errors)) /*Comprueba si el array está vacio, si hubiera errores deberian estar ahí*/{
            echo 'Uh-oh.. Un par de campos no están correctamente rellenos..';
            echo '<ul>';
            foreach($errors as $key => $value) /* Recorre el array y muestra los errores */{
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>';
        }
    
        else{
    
            /*el formulario no contiene errores
            asi que procedemos al tercer paso
            y guardamos la información*/
            $username = $_POST['user_name'];
            $passwrd = $_POST['user_pass'];
            $userPasswrd = MD5($passwrd);
            $userMail = $_POST['user_email'];
            $date = date('Y-m-d H:i:s');
            $userLevel = 0;
            $data = [
                'username' => $username,
                'userPasswrd' => $userPasswrd,
                'userMail' => $userMail,
                'userDate' => $date,
                'userLevel' => $userLevel,
            ];
            insertUsr($data);
            echo "<h5>Registro Correcto</h5>";
        }
    }
}

function category(){
$i = showCategoryName($_GET['catID']); // Busca el nombre de la categoría para mostrarlo arriba
$catID = $_GET['catID'];            // Los calores de catID y topicID lo vamos pasando hasta createTopic
$catName = implode($i[0]);          // Para usarlos en caso de necesitarlos al crear topic o ¿reply?
$topics = showTopics();

echo "<div class='row' style='margin-top:5%'>
         
        </div>";
echo "<div class = 'mx-auto'>
    <table class='table table-dark'>
        <tr class='justify-content-md-center'>
        <th>$catName</th>
        </tr>
    </table>
</div>";
if(!$topics){
    echo 'No se pueden mostrar los temas, por favo inténtelo mas tarde.';
    echo '<tr>';
    echo "<td>";
        echo '<a class="btn btn-info" href="createTopic.php?catID='.$catID.'">Crear Tema Nuevo!</a>';
    echo "</td>";
    echo "<td>";
        echo '<a class="btn btn-danger" href="index.php">Volver</a>
        </td>';
    
    }else{
        echo '<div class="container" >';
        //prepare the table
            echo '<table class="table table-dark table-striped">    
                    <thead>
                        <th>Tema</th>
                        <th>Fecha de creación</th>
                    </thead>
                    <tbody>'; 
                    foreach($topics as $i) {
                        echo "<tr>";
                        echo '<td class="leftpart" >';
                            echo '<a style ="color:#c154c1" href="topic.php?topicID='.$i['topicID'] .'&catID='.$catID.'">'.'<i class="fa-solid fa-message"></i>'.$i['topicName'].'</a>';
                        echo '</td>';
                        echo '<td class= "rightpart">';
                            echo $i['topicDate'];
                        echo '</td>';
                        echo "</tr>";
                    }
                        echo '<tr>';
                            echo "<td>";
                                echo '<a class="btn btn-info" href="createTopic.php?catID='.$catID.'">Crear Tema Nuevo!</a>';
                            echo "</td>";
                            echo "<td>";
                            echo '<a class="btn btn-danger" href="index.php">Volver</a>';
                            //Aqui va la funcionalidad para borrar del admin
                        //     echo "</td>";
                        //     if($_SESSION['userLevel'] = 1){
                        //         echo "<td>";
                        //         echo '<a class="btn btn-danger" href="index.php">Borrar</a>';
                        //         echo "</td>";
                        //     }
                        // echo '</tr>';
                        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }
    
}

function topic(){
    $catID = $_GET['catID'];
    $topicID = $_GET['topicID'];
    $i = showTopicName($topicID);
    $topicName = implode($i[0]);
    //$topics = showTopicOP();
    $replies = showReplies();

   
            echo "<div class='row' style='margin-top:5%'>
            </div>";
            echo '<div class="container" >';
            //prepare the table, tengo que poner el TITULO arriba con $topicName
                echo "<table class='table table-dark table-striped'>    
                        <thead>
                            <th>Publicado por:</th>
                            <th>$topicName</th>
                        </thead>";
                        echo '<tbody>'; 
                            // foreach($topics as $i) {
                            //     $x = getUsrName($i['userID']);
                            //     $userName = implode($x[0]);
                            //     echo "<tr>";
                            //     echo '<td class="leftpart" >';
                            //         echo '<i class="fa-solid fa-user"></i>';
                            //         echo $userName.'<br>';
                            //         echo $i['topicDate'];
                            //     echo '</td>';
                            //     echo '<td class= "rightpart">';
                            //         echo $i['topicSubject'];
                            //     echo '</td>';
                            //     echo "</tr>";
                            // }

                            foreach($replies as $i) {
                                $x = getUsrName($i['userID']);
                                $userName = implode($x[0]);
                                echo "<tr>";
                                echo '<td class="leftpart" >';
                                    echo '<i class="fa-solid fa-user"></i>';
                                    echo $userName.'<br>';
                                    echo $i['replyDate'];
                                echo '</td>';
                                echo '<td class= "rightpart w-auto p-3" colspan="2">';
                                    echo $i['replyContent'];
                                echo '</td>';
                                echo "</tr>";
                            }
                            echo '<tr>';
                                echo "<td>";
                                    echo '<a class="btn btn-info" href="createReply.php?topicID='.$topicID.'&catID='.$catID.'">Responder!</a>';
                                echo "</td>";
                                echo "<td>";
                                    echo '<a class="btn btn-danger" href="category.php?catID='.$catID.'">Volver</a>';
                                echo "</td>";
                                echo "<td>";
                                    echo '<a target="_blank" class="btn btn-warning" href="pdf.php?topicID='.$topicID.'&catID='.$catID.'">Generar PDF</a>';
                                echo "</td>";
                            echo '</tr>';
                        echo "</tbody>";
                    echo "</table>";
                echo "</div>";
        }
    

function createReply(){
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        $catID = $_GET['catID'];
        echo <<<EOT
            <div style='margin-top:5%'></div>
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
    
         /*if(!ctype_alnum(str_replace(' ','',$_POST['replyContent']))){
             $errors[] = 'El mensaje sólo puede contener letras y números.';
         }
            //Comprueba que no tenga una longitud superior a 300
            if(strlen($_POST['replyContent']) > 300){
                $errors[] = 'El mensaje no puede ser superior a 300 carácteres.';
            }
            if(!isset($_POST['replyContent'])){
                $errors[] = 'El mensaje no puede estar vacío.';
            }*/
    
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
                    <p>Respuesta creada con éxito.<a href="topic.php?topicID=$topicID&catID=$catID">Ver Respuesta</a></p>
                </div>
                EOT;
        }
    }
}

function createTopic(){
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    $catID = $_GET['catID'];
    echo <<<EOT
        <div style='margin-top:5%'></div>
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

     if((!ctype_alnum(str_replace(' ','',$_POST['topicSubject'])))){
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
            'topicDate' => $date,
            ];
        

        insertTopic($data);
        $i = getTopicID($topicName);
        $topicIDArray = $i[0];
        $topicID = $topicIDArray['topicID'];
        $reply = [
            'topicID' => $topicID,
            'userID' => $userID,
            'replyContent' => $topicSubject,
            'replyDate' => $date
        ];
        insertReply($reply);
        //Buscamos el id del topic para el botón volver
        
        echo <<< EOT
            <div class="container" >
                <p>Tema creado con éxito.<a href="topic.php?topicID=$topicID&catID=$catID">Volver</a></p>
            </div>
            EOT;
    }
}
}

function categories(){
$categories = showCategories();

if(!$categories){
    echo 'No se pueden mostrar las categorías, por favo inténtelo mas tarde.';
}else{
    if(count($categories) == 0){
        echo 'No hay categorías creadas';
    }else{
        echo "<div style='margin-top:5%'>
        </div>";
        echo '<div class="container" >';
        //prepare the table
        echo '<table class="table table-dark table-striped">
              <thead>
                <th>Nombre de la Categoría</th>
                <th>Último tema:</th>
              </thead>'; 
        foreach($categories as $i) {
            echo "<tr>";
            echo '<td class="leftpart" >';
                echo '<h4><a style ="color:#c154c1"href="category.php?catID='.$i['catID'] .'" ><i class="fa-solid fa-code"></i>'.$i['catname'].'</a></h4>' . $i['catDesc'];
            echo '</td>';
            echo '<td class= "rightpart">';
                //Un poco enreversado, pero con end toma los últimos valores
                //del array ordenado por fecha que dvuelve getLasTopic()
                $getLastTopic = getLastTopic($i['catID']);
                $lastTopic = end($getLastTopic);
                echo '<a style ="color:#c154c1" href="topic.php?topicID='.$lastTopic['topicID'] .'&catID='.$lastTopic['catID'].'">'.$lastTopic['topicName'].'</a>'.$lastTopic['topicDate'];
            echo '</td>';
            echo "</tr>";
        }
    }    echo "</table>";
}
echo "</div>";
}

function errorLog(){
    error_reporting(E_ALL);
    ini_set('ignore_repeated_errors', TRUE);
    ini_set('display_errors', FALSE);
    ini_set('log_errors', TRUE);
    ini_set('error_log','php-error.log');
}

?>