<?php
require_once('./Controllers/controller.php');
require_once('./View/header.php');

$catID = $_GET['catID'];
$topicID = $_GET['topicID'];
$i = showTopicName($topicID);
$topicName = implode($i[0]);
$topics = showTopicOP();
$replies = showReplies();

if(!$topics){
    echo 'No se pueden mostrar los temas, por favo inténtelo mas tarde.';
    }else{
        echo '<div class="container" >';
        //prepare the table
            echo '<table border="1">    
                    <thead>
                        <th>'.$topicName.'</th>
                    </thead>';
            echo '<tbody>'; 
                    foreach($topics as $i) {
                        echo "<tr>";
                        echo '<td class="leftpart" >';
                            echo $i['userID'].'<br>';
                            echo $i['topicDate'];
                        echo '</td>';
                        echo '<td class= "rightpart">';
                            echo $i['topicSubject'];
                        echo '</td>';
                        echo "</tr>";
                    }

                    foreach($replies as $i) {
                        echo "<tr>";
                        echo '<td class="leftpart" >';
                            echo $i['userID'].'<br>';
                            echo $i['replyDate'];
                        echo '</td>';
                        echo '<td class= "rightpart">';
                            echo $i['replyContent'];
                        echo '</td>';
                        echo "</tr>";
                    }

            echo "</table>";
            echo '</tbody>';
        echo "</div>";
        echo '<div class="container" >';
            echo '<a href="category.php?catID='.$catID.'">Volver</a>';
        echo '</div>';
        echo '<div class="container" >';
            echo '<form>';
                echo '<a href="createReply.php?topicID='.$topicID.'&catID='.$catID.'">Responder</a>';
            echo '</form>';
    echo '</div>';
    }

require_once('./View/footer.php');
?>