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
        if(strlen($_POST['name'])>75 or strlen($_POST['username'])>25 or strlen($_POST['password'])>25){
            echo "Name should not be longer than 75 characters.\n Username and password should not be longer than 25 characters.\n";
            exit();
        }
        if(trim($_POST['name'])=='' or trim($_POST['username'])=='' or trim($_POST['password'])==''){
            echo "Fields cannot be empty";
            exit();
        }
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