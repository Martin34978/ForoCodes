<?php
//Incluyo los require para que se envie completo
//el documento html, con sus etiquetas cerradas, etc..
require_once('./View/header.php');
session_destroy();
header('Location: index.php');
require_once './View/footer.php';
?>