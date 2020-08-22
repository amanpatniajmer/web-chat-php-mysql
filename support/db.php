<?php
$db=mysqli_connect('localhost','root','','chat');
if(!$db){
    die("Connection failed: " . mysqli_connect_error());
}
?>