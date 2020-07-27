<?php
include 'db.php';
switch ($_POST['submit']) {
    case 'Send':
        $msg= $_POST['msg'];
        echo $msg;
        break;
    
    default:
        echo "Error";
        break;
}


?>