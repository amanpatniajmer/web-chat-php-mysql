<?php
include 'db.php';
switch ($_POST['submit']) {
    case 'Send':
        $msg= $_POST['msg'];
        echo $msg;
        break;
    
    default:
        echo "Error";
        break;
}
/* $socket=socket_create(AF_INET,SOCK_STREAM,0);
$host="127.0.0.1";
socket_bind($socket,$host,2014);
//socket_listen($socket,10);
$msg="aman";
socket_connect($socket,$host,80);
$request= 'GET / HTTP/1.1 . "\r\n"'. 'Host: localhost'. "\r\n\r\n"; 
socket_write($socket,$request); */
/* header("location /foo/ {
    proxy_pass http://foobar:3005/;
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection 'upgrade';
    proxy_set_header Host $host;
}"); */
//socket_write($socket,$msg,strlen($msg));
/* if(socket_connect($socket,$host,80)){
    echo "Connected";
    $msg=["aj","aman"];
    $flags=01;
    socket_sendmsg($socket, $msg,$flags);
} */


?>