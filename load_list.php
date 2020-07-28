<?php
include 'db.php';
$query="SELECT user1 FROM master WHERE user2='".$_POST['username']."'";
$list= array();
$result= mysqli_query($db, $query);
while($row = mysqli_fetch_assoc($result)){
array_push($list , $row['user1']);
}
$query="SELECT user2 FROM master WHERE user1='".$_POST['username']."'";
$result= mysqli_query($db, $query);
while($row = mysqli_fetch_assoc($result)){
array_push($list, $row['user2']);
}
echo json_encode($list);
?>