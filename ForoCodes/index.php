<?php

        /*      La página index muestra
                las categorías              */

require_once('./Controllers/controller.php');
require_once('./View/header.php');
$categories = showCategories();

if(!$categories){
    echo 'No se pueden mostrar las categorías, por favo inténtelo mas tarde.';
}else{
    if(count($categories) == 0){
        echo 'No hay categorías creadas';
    }else{
        echo '<div class="container" >';
        //prepare the table
        echo '<table border="1">
              <thead>
                <th>Nombre de la Categoría</th>
                <th>Último tema:</th>
              </thead>'; 
        foreach($categories as $i) {
            echo "<tr>";
            echo '<td class="leftpart" >';
                echo '<h4><a href="category.php?catID='.$i['catID'] .'">'.$i['catname'].'</a></h4>' . $i['catDesc'];
            echo '</td>';
            echo '<td class= "rightpart">';
                echo '<a href="topic.php?catID='.$i['catID'] .'">Tema</a> 10-10';
            echo '</td>';
            echo "</tr>";
        }
    }    echo "</table>";
}
echo "</div>";
require_once('./View/footer.php');
?>