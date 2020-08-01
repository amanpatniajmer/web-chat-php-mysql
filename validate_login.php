<?php
include 'db.php';
switch ($_POST['submit']) {
    case 'login':
        //FILTER_SANITIZE_EMAIL
        //filter_var($a,fILTER)
        if(trim($_POST['username'])=='' or trim($_POST['password'])==''){
            $json=['name'=>'','message'=>'Fields cannot be empty'];
            echo json_encode($json);
            exit();
        }
        if(preg_match_all("/([\"'();])/",trim($_POST['username']))){
            $json=['name'=>'','message'=>'Special characters are not allowed.'];
            echo json_encode($json);
            exit();
        }
        if(preg_match_all("/([\"'();])/",trim($_POST['password']))){
            $json=['name'=>'','message'=>'Special characters are not allowed.'];
            echo json_encode($json);
            exit();
        }
        $query = "SELECT name FROM users WHERE username='" . $_POST['username'] . "' AND pass='" . htmlentities($_POST['password']) . "'";
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
        else{
            $status=$_POST['status'];
            $username=$_POST['username'];
            $query="UPDATE users SET status=$status WHERE username='$username'";
            $result=mysqli_query($db,$query);
        }
        break;
    case 'logout':
        setcookie('authorize');
        $username=$_POST['username'];
        $query="UPDATE users SET status=0 WHERE username='$username'";
        if($result=mysqli_query($db,$query)){
            echo $result;
        }
    break;
    case 'SignUp':
        if(preg_match_all("/([\"'();])/",trim($_POST['username']))){
            echo "Special characters are not allowed.";
            exit();
        }
        if(preg_match_all("/([\"'();])/",trim($_POST['password']))){
            echo "Special characters are not allowed.";
            exit();
        }
        if(strlen($_POST['name'])>75 or strlen($_POST['username'])>25 or strlen($_POST['password'])>25){
            echo "Name should not be longer than 75 characters.\n Username and password should not be longer than 25 characters.\n";
            exit();
        }
        if(trim($_POST['name'])=='' or trim($_POST['username'])=='' or trim($_POST['password'])==''){
            echo "Fields cannot be empty";
            exit();
        }
        if(!preg_match_all('/^(([A-Za-z]+[\s]?)+)$/',trim($_POST['name']))){
            echo "Name should only contains alphabets and maximum of one continous white space.";
            exit();
        }
        if(!preg_match_all("/^([\S]+)$/",trim($_POST['username']))){
            echo "No white spaces allowed in username";
        }
        $query = "INSERT INTO users (name,username,pass) VALUES ('".trim($_POST['name'])."','".trim($_POST['username'])."','".trim($_POST['password'])."')";
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