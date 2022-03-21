<?php
require_once('./View/header.php');
session_destroy();
header('Location: index.php');
include './View/footer.php';
?>