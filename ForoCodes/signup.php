<?php
require_once('./Controllers/controller.php');
require_once('./View/header.php');
 
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
        $userPasswrd = $_POST['user_pass'];
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
    }
}
 
include './View/footer.php';
?>