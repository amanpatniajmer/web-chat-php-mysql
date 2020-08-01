<?php
    include 'db.php';
    $json=array();
    switch ($_POST['submit']) {
        case 'initial':
            /* array_push($json,date('D M d Y H:i:s O')); */
            $table=$_POST['table_name'];
            $query="SELECT * FROM ".$table." ORDER BY year ASC, month ASC, day ASC, hour ASC, min ASC, sec ASC";
            break;
        case 'partial':
            /* $date=date('D M d Y H:i:s:u O');
            /* $date */
            /* array_push($json,$date); */
            $year=$_POST['year'];
            $month=$_POST['month'];
            $day=$_POST['day'];
            $h=$_POST['h'];
            $m=$_POST['m'];
            $s=$_POST['s'];
            $table=$_POST['table_name'];
            $user2=$_POST['username'];
            $id=$_POST['id'];
            /* $query="SELECT * FROM ".$table." WHERE (from_user='$user2' AND year>=$year AND month>=$month AND day>=$day AND hour>=$h AND min>=$m AND sec>=$s)ORDER BY year ASC, month ASC, day ASC, hour ASC, min ASC, sec ASC"; */
            $query="SELECT * FROM ".$table." WHERE (from_user='$user2' AND id>$id)ORDER BY year ASC, month ASC, day ASC, hour ASC, min ASC, sec ASC";
            break;
        default:
            echo json_encode("invalid"); 
            exit();
            break;
    }
    if ($result = mysqli_query($db, $query)) {
            $user2=$_POST['username'];
            $a="SELECT status from users WHERE username='$user2'";
            $status=mysqli_query($db,$a);
            while($b=mysqli_fetch_assoc($status))
            array_push($json,$b);
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