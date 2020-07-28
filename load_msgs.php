<?php
    include 'db.php';
    $query="SELECT * FROM ".$_POST['table_name'];
    if ($result = mysqli_query($db, $query)) {

        /* fetch associative array */
            $json=array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($json,$row);
        }
        echo json_encode($json);
        
     /* }
        else{
            $json=['table_name'=>'','message'=>'Invalid Users'];
            echo json_encode($json);
        } */

        /* free result set */
        mysqli_free_result($result);
    } else {
        $json=['name'=>'','message'=>'Invalid User'];
            echo json_encode($json);
        
    }
?>