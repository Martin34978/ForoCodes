<?php
require_once('./Controllers/controller.php');
require_once('./View/header.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    /*Si el formulario no ha sido enviado, muestralo
      el acntio="" deberia redirigir a la misma página */
    echo '<form method="post" action="">
        Username: <input type="text" name="user_name" />
        Password: <input type="password" name="user_pass">
        <input type="submit" value="Ingresar" />
     </form>';
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
            // mirar de añadir la id
            $_SESSION['username'] = "$username";
            header('Location: index.php');
        }else{
            echo "not ok";
        }
    }
}
include './View/footer.php';
?>