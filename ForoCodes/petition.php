<?php
require_once 'Controllers/controller.php';
$name = $_GET['sName'];

if(!empty($name)){
    echo '<table class="table table-dark table-striped">'; 
    $out = searchUser($name);
    
    for($i=0; $i<sizeof($out); $i++){
        $topicName = showTopicName($out[$i]['topicID']);
        echo '<tr>';
        echo '<td>'.$out[$i]['replyContent'].'</td>
                <td>'.$topicName[0]['topicName'].'</td>';
        echo '</tr>';
        
    }
    echo '</table>';
  
}  

?>