<?php
session_start();
if (!isset($_COOKIE['authorize']) or !($_COOKIE['authorize'] == true)) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </link>
</head>
<style>
    * {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        word-wrap: break-word;
        word-break: break-all;
    }

    .center {
        margin: auto;
        text-align: center;
    }

    .container {
        margin: auto;
        max-width: 500px;
        background-color: white;
        color: white;
        max-height: 100vh;
        box-shadow: 2px 0px 21px 0px rgba(0, 0, 0, 0.33);
        border-radius:15px 15px 15px 15px;
    }

    .header {
        padding: 15px;
        background-color: rgb(119, 64, 207);
        border-radius:15px 15px 0px 0px;
    }

    #chatPanel {
        width: inherit;
        background-color: rgba(0, 0, 0, 0.33);
        height: calc(100vh - 200px);
        display: flex;
        align-items: flex-end;
        flex-flow: column;
        padding: 5px;
        overflow: auto;
        
    }

    #input_div {
        border: black solid 1px;
        display: flex;
        flex-flow: column;
        width: 100%;
        border-radius: 0px 0px 15px 15px;
    }

    input {
        font-size: 16px;
        padding: 5px;
        outline: none;
        border: none;
        border-radius: 0px 0px 15px 15px;
    }

    input[type=text] {
        
        width: 88%;
    }

    input[type=text]:focus {
        outline: none;
        border: none;
    }

    
    #msg_form {
        margin: 0;
    }

    .msg {
        width: 100%;
        display: flex;
        flex-flow: column;
    }

    .mymsg {
        color: black;
        max-width: 85%;
        display: flex;
        flex-flow: column;
        align-self: flex-end;
        padding: 5px;
        border-radius: 8px;
        background-color: #ececec;
        margin-top: 5px;
        box-shadow: 2px 10px 21px 0px rgba(0, 0, 0, 0.33);
    }

    .yourmsg {
        max-width: 85%;
        display: flex;
        flex-flow: column;
        align-self: flex-start;
        padding: 5px;
        border-radius: 8px;
        background-color: lightgreen;
        color: black;
        margin-top: 5px;
        box-shadow: 2px 10px 21px 0px rgba(0, 0, 0, 0.33);

    }

    .time {
        align-self: flex-end;
        float: right;
        color: grey;
        font-size: 10px;
    }

    i {
        
        color: black;
    }
    button[type=submit]{
        font-size: 25px;
        align-self: flex-end;
        border-radius: 100%;
        outline: none;
        border:none;
    }
    #secret{
        background-color: rgba(255,255,255,1);
        display: none;
        height: 100vh;
        width: 100vw;
        position: fixed;
    }
    .options{
        float: right;
        border:none;
        border-radius: 15px 15px 15px 15px;
        margin: 5px;
        font-size: 15px;
        cursor: pointer;
    }
</style>

<body>
    <div id="secret"></div>
    <h1 class="center">Welcome <span class='name'>Name</span></h1>
    
    <div class="container">
    
        <div class="header">
                <i class=" fa fa-user-circle"></i>
            <span class='username'>UserName</span>
            <a href=""><button id="otherChats" class="options"> Other Chats</button></a>
            <a href="logout.php"><button id="logout" class="options"> Logout</button></a>
            
            
            
        </div>
        <div id="chatPanel">
            <br /><br /><br /><br />
            <div class="msg">
                <div class="mymsg">
                    AJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJ
                </div>
            </div>
            <div class="msg">
                <div class="yourmsg">
                    AANC
                </div>
            </div>
            <div class="msg">
                <div class="mymsg">
                    AJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJAJ
                    <div class="time">
                        10:30
                    </div>
                </div>
            </div>
            <div class="msg">
                <div class="yourmsg">
                    AANC
                    <div class="time">
                        10:30
                    </div>
                </div>
            </div>
            <div class="msg">
                <div class="yourmsg">
                    AANC
                </div>
            </div>
            <div class="msg">
                <div class="yourmsg">
                    AANC
                </div>
            </div>
            <div class="msg">
                <div class="yourmsg">
                    AANC
                </div>
            </div>
            <div class="msg">
                <div class="yourmsg">
                    AANC
                </div>
            </div>
        </div>
        <div id="input_div">
            <form id="msg_form" method="POST" action="./send.php">
                <input type="text" name="msg" id="msg" autofocus autocomplete="off" placeholder="Type your msg">
<!--                 <input type="submit" name="submit" id="send" value="Send"> -->
                <button type="submit" name="submit" id="send" value="Send"><i class="fa fa-paper-plane"></i></button>
            </form>
        </div>

    </div>
    <button id="add">Class</button>
    <div id="content"></div>
    <script>
        
        
        window.onload=function(){
            
            window.addEventListener('keydown',function(e){
            if(e.which==17 || e.key=='17'){
                sessionStorage.setItem('secret',1);
            document.getElementById('secret').style.display='block';
            }
        });
        window.addEventListener('keydown',function(e){
            if(e.which==16){
                sessionStorage.setItem('secret',0);
            document.getElementById('secret').style.display='none';
            }
        })
        /* if(sessionStorage.getItem('secret')==1){ 
            var evt=new KeyboardEvent('keydown',{ 'key': 17, 'which': 17 });
            document.dispatchEvent(evt);
            console.log(evt);
            } */
        }
        
        Array.from(document.getElementsByClassName('name')).forEach(function(element){
            element.innerHTML=localStorage.getItem('name');
        })
        Array.from(document.getElementsByClassName('username')).forEach(function(element){
            element.innerHTML=localStorage.getItem('username');
        })
        document.getElementById('msg').onchange=function(){
            document.getElementById('msg').setAttribute('placeholder','');
        }
        var chatPanel = document.getElementById('chatPanel');
        chatPanel.scrollTop = chatPanel.scrollHeight;
        var content = document.getElementById('content');
        setInterval(function() {
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.status >= 200)
                    content.innerHTML = xhr.responseText;
            }
            xhr.open('get', './aj.txt');
            xhr.send();
        }, 100000);
        document.getElementById('add').addEventListener('click', function() {
            Array.from(document.getElementsByClassName('yourmsg')).forEach(function(element) {
                element.className = "mymsg";
            })
        })

        function send_msg(msg,d) {
            var xhr = new XMLHttpRequest();
            var formdata = new FormData();
            formdata.append('msg', msg);
            formdata.append('day',d.getDate());
            formdata.append('month', d.getMonth());
            formdata.append('year', d.getFullYear());
            formdata.append('h', d.getHours());
            formdata.append('m', d.getMinutes());
            formdata.append('s', d.getSeconds());
            formdata.append('submit', 'Send');
            return new Promise(function(resolve, reject) {
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300) {
                        resolve(xhr);
                        console.log(xhr.responseText);
                    }
                }
                xhr.open('post', './send.php');
                xhr.send(formdata);
            })
        }

        function load_msgs() {
            var xhr = new XMLHttpRequest();
            return new Promise(function(resolve) {
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        console.log(xhr.responseText);
                    }
                }
                xhr.open('post', './getAll.php');
                xhr.send();
            })
        }

        document.getElementById('send').addEventListener('click', function() {
            var msg = document.getElementById('msg').value;
            var new_msg = document.createElement('div');
            new_msg.className = "msg";
            var new_mymsg = document.createElement('div');
            new_mymsg.className = "mymsg";
            new_mymsg.innerText = msg;
            var new_time = document.createElement('div');
            new_time.className = "time";
            var d = new Date();
            var date = d.getDate() + "/" + eval(d.getMonth() + 1) + "/" + d.getFullYear() + "   " + d.getHours() + ":" + d.getMinutes();
            new_time.innerText = date;
            new_mymsg.append(new_time);
            new_msg.append(new_mymsg);
            chatPanel.append(new_msg);
            chatPanel.scrollTop = chatPanel.scrollHeight;
            console.log(new_msg);
            send_msg(msg,d).then(function() {
                document.getElementById('msg').value = '';
                document.getElementById('msg').setAttribute('placeholder','Type your msg');
                //load_msgs();
            })

        })
        var form = document.getElementById('msg_form');
        form.onsubmit = function() {
            return false;
        }
        setInterval(function(){authenticate() .then(function(xhr){
                if(xhr.responseText=="Invalid User"){window.location.href="index.php";}
            })},5000);
        function authenticate() {
            var xhr = new XMLHttpRequest();
            return new Promise(function(resolve) {
                var formdata= new FormData();
                formdata.append('submit','check');
                console.log(formdata);
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        console.log(xhr.responseText);
                        
                    }
                }
                xhr.open('post', './validate_login.php');
                xhr.send(formdata);
            })
        }
    </script>
</body>

</html>

<?php
session_destroy();

?>