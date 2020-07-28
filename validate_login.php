<?php
include 'db.php';
switch ($_POST['submit']) {
    case 'login':
        $query = "SELECT name FROM users WHERE username='" . $_POST['username'] . "' AND pass='" . $_POST['password'] . "'";
        if ($result = mysqli_query($db, $query)) {

            /* fetch associative array */
            if ($row = mysqli_fetch_assoc($result)) {
                setcookie('authorize', true, time() + 60 * 60);
                $json=['name'=>$row['name'],'username'=>$_POST['username']];
                echo json_encode($json);
                exit();
            } else {
                $json=['name'=>'','message'=>'Invalid Credentials'];
                echo json_encode($json);
            }

            /* free result set */
            mysqli_free_result($result);
        } else {
            $json=['name'=>'','message'=>'Invalid User'];
                echo json_encode($json);
            
        }
        break;

    case 'check':

        if (!(isset($_COOKIE['authorize'])) or ($_COOKIE['authorize'] == false)) {
            echo "Invalid User";
        }
        break;
    case 'SignUp':
        $query = "INSERT INTO users (name,username,pass) VALUES ('".$_POST['name']."','".$_POST['username']."','".$_POST['password']."')";
        $result=mysqli_query($db,$query);
        if($result){
            echo "success";
        }else{
            echo "Username should be unique.";
        }
        break;
    default:
    header("location: aj.html");
        echo "Invalid Action";
}
?>