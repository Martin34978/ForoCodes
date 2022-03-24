<?php
require_once('./Controllers/controller.php');
require_once('./View/header.php');

$categories = showCategories();
$i = showCategoryName($_GET['catID']); // Busca el nombre de la categoría para mostrarlo arriba
$catID = $_GET['catID'];            // Los calores de catID y topicID lo vamos pasando hasta createTopic
$catName = implode($i[0]);          // Para usarlos en caso de necesitarlos al crear topic o ¿reply?
$topics = showTopics();

echo "<h3>$catName</h3>";
if(!$topics){
    echo 'No se pueden mostrar los temas, por favo inténtelo mas tarde.';
    }else{
        echo '<div class="container" >';
        //prepare the table
            echo '<table border="1">    
                    <thead>
                        <th>Tema</th>
                        <th>Fecha de creación</th>
                    </thead>'; 
                    foreach($topics as $i) {
                        echo "<tr>";
                        echo '<td class="leftpart" >';
                            echo '<h6><a href="topic.php?topicID='.$i['topicID'] .'&catID='.$catID.'">'.$i['topicName'].'</a></h6>';
                        echo '</td>';
                        echo '<td class= "rightpart">';
                            echo $i['topicDate'];
                        echo '</td>';
                        echo "</tr>";
                    }
        echo "</table>";
        echo "</div>";
    }
    echo '<a href="createTopic.php?catID='.$catID.'">Crear Tema Nuevo!</a>';
    echo '<a href="index.php">Volver</a>';
require_once('./View/footer.php');
?>