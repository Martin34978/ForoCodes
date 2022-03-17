<?php
require_once('./Controllers/controller.php');
require_once('./View/header.php');

showCategories();
echo '<a href="topic.php">Topics</a>';
require_once('./View/footer.php');
?>