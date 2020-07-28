<?php
    include 'db.php';
    $query="SELECT table_name FROM master WHERE (user1='".$_POST['user1']."' AND user2='".$_POST['user2']."') OR (user2='".$_POST['user1']."' AND user1='".$_POST['user2']."')";
    if ($result = mysqli_query($db, $query)) {

        /* fetch associative array */
        if ($row = mysqli_fetch_assoc($result)) {
            $json=['table_name'=>$row['table_name']];
            echo json_encode($json);
            exit();
        } else {
            $json=['table_name'=>'','message'=>'Invalid Users'];
            echo json_encode($json);
        }

        /* free result set */
        mysqli_free_result($result);
    } else {
        $json=['name'=>'','message'=>'Invalid User'];
            echo json_encode($json);
        
    }
?>
