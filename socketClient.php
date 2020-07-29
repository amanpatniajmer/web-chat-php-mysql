


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <input type="text" name="table_name">

        <input type="submit" name="btnSend" value="send">
    </form>
    <?php
    if(isset($_POST['btnSend'])){
        $msg=$_POST['table_name'];
        $socket=socket_create(AF_INET,SOCK_STREAM,0);
        echo "socket Created  ";

        socket_connect($socket,"127.0.0.1",20204);
        echo "socket Connected  ";
        socket_write($socket,$msg,strlen($msg));
        echo "socket written  ";
        $reply=socket_read($socket,1000);
        echo $reply;
    }

?>
    <script>
        /* if ('WebSocket' in window) {
            (function() {
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + "localhost:20205/";
                console.log(address);
                var socket = new WebSocket(address);
                console.log(socket);
                socket.onopen = function() {
                    console.log("Opened");
                }
                socket.onerror = function(e) {
                    console.log(e);
                }
                socket.onclose = function() {
                    console.log("Closed");
                }
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') console.log('asdf');
                    else console.log('aman');
                };
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
 */


        /* var ws=new WebSocket("ws://localhost:20205/");
        ws.onopen=function(){
            console.log("Connection opened");
        } */
    </script>
</body>

</html>