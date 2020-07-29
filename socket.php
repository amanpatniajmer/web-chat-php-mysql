<?php
include 'db.php';

    $socket=socket_create(AF_INET,SOCK_STREAM,0);
if(!$socket) die("Creation Failed");
echo "Socket created\n";
$bind=socket_bind($socket,"127.0.0.1",20204);
if(!$bind) die("Binding Failed");
echo "Socket binded\n";


class Chat{
	function readline() {
		return rtrim(fgets(STDIN));
	}
}

$bind=socket_listen($socket,10) or die ("Listening Failed");
echo "Listening for connections....";
while(true){
	$accept=socket_accept($socket) or die("Accepting Failed");
	echo "Socket accepted\n";
	echo "Socket reading\n";
	
	$msg=socket_read($accept,1000) or die("Reading Failed");
	$query="SELECT * FROM ".$msg." ORDER BY year ASC, month ASC, day ASC, hour ASC, min ASC, sec ASC";
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
	

	echo $msg;
	$msg=trim($msg);
	//echo "Msg=".$msg;
	$line=new Chat();
	echo "Enter reply";
	$reply="Hi from AJ WebSocket";
	echo "Socket replying\n";
	//$reply=$line->readline();

	socket_write($accept,json_encode($json),strlen(json_encode($json))) or die("Writing Failed");
}
socket_close($accept,$socket);
echo "Socket Closed";
?>