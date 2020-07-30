<?php
include 'db.php';
$username=trim($_POST['username']);
$new_friend=trim($_POST['new_friend']);
if($username=='' or $new_friend==''){
    echo 'Cannot be empty';
    exit();
}
if(preg_match_all("/([\"'();])/",$new_friend)){
    echo 'Special characters are not allowed.';
    exit();
}
if(preg_match_all("/([\"'();])/",$username)){
    echo 'Malicious activity detected.';
    exit();
}
if($username==$new_friend){
    echo "Cannot add yourself"; exit();
}
$query="SELECT * FROM master WHERE user1='".$username."' AND user2='".$new_friend."' ";
if($result = mysqli_query($db,$query)) {
    if($row=mysqli_fetch_assoc($result))
        {echo "Already added as a friend"; exit();}
}
$query="SELECT * FROM master WHERE user2='".$username."' AND user1='".$new_friend."' ";
if($result = mysqli_query($db,$query)) {
    if(mysqli_fetch_assoc($result))
    {echo "Already added as a friend"; exit();}
}

$query="SELECT * FROM users WHERE username='".$new_friend."' ";
if(($result = mysqli_query($db,$query))){
if(!($row=mysqli_fetch_assoc($result)))
{echo "Incorrect Username"; exit();}
else{
    $query="INSERT INTO master (user1,user2) VALUES('".$username."', '".$new_friend."')";
    if($result=mysqli_query($db,$query)){
    $query = "SELECT id FROM master WHERE user1='".$username."' AND user2='".$new_friend."'";
    if($result=mysqli_query($db,$query)){
        while($row=mysqli_fetch_assoc($result))
        $id=$row['id'];
    $query="CREATE TABLE chat".$id." ( from_user VARCHAR(25) NOT NULL , to_user VARCHAR(25) NOT NULL , msg VARCHAR(1500) NOT NULL , year INT(4) NOT NULL , month INT(2) NOT NULL , day INT(2) NOT NULL , hour INT(2) NOT NULL , min INT(2) NOT NULL , sec INT(2) NOT NULL )";
    if($result=mysqli_query($db,$query)){
        echo "success";    
    }
    else echo "failed".$id;
} 
else{
    echo "Cant fetch last id";
}
}
}
}
?>