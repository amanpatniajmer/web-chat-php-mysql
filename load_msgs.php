<?php
    include 'db.php';
    switch ($_POST['submit']) {
        case 'initial':
            $table=$_POST['table_name'];
            $query="SELECT * FROM ".$table." ORDER BY year ASC, month ASC, day ASC, hour ASC, min ASC, sec ASC";
            break;
        case 'partial':
            $year=$_POST['year'];
            $month=$_POST['month'];
            $day=$_POST['day'];
            $h=$_POST['h'];
            $m=$_POST['m'];
            $s=$_POST['s'];
            $table=$_POST['table_name'];
            $query="SELECT * FROM ".$table." WHERE (year>=$year AND month>=$month AND day>=$day AND hour>=$h AND min>=$m AND sec>=$s)ORDER BY year ASC, month ASC, day ASC, hour ASC, min ASC, sec ASC";
            break;
        default:
            echo json_encode("invalid"); 
            exit();
            break;
    }
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