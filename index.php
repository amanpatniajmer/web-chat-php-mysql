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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<style>
    * {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        word-wrap: break-word;
        word-break: break-all;
    }

    h1,
    .name {
        font-family: cursive;
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

        border-radius: 0px 0px 15px 15px;
    }

    .header {
        padding: 15px;
        background-color: rgba(119, 64, 207, 1.0);
        border-radius: 15px 0px 0px 0px;
        box-shadow: 0px 0px 21px 0px rgba(0, 0, 0, 0.33);
    }

    #chatPanel {
        box-shadow: 2px 10px 21px 0px rgba(0, 0, 0, 0.33);
        width: inherit;
        background-color: rgba(0, 0, 0, 0.61);
        height: calc(100vh - 250px);
        display: flex;
        align-items: flex-end;
        flex-flow: column;
        padding: 5px;
        overflow: auto;

    }

    #input_div {

        display: flex;
        flex-flow: column;
        width: 100%;
        border-radius: 0px 0px 15px 15px;
        box-shadow: 2px 10px 21px 0px rgba(0, 0, 0, 0.33);
    }

    input {
        font-size: 16px;
        padding: 5px;
        outline: none;
        border: none;
        border-radius: 0px 0px 15px 15px;
    }

    input[type=text],
    textarea,
    textarea:focus {
        height: 50px;
        resize: none;
        outline: none;
        border: none;
        word-break: break-all;
        overflow: auto;
        width: 88%;
        border-radius: 0px 0px 15px 15px;
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
        background-color: rgb(200 130 247 / 70%);
        color: black;
        margin-top: 5px;
        box-shadow: 5px 8px 6px 1px rgba(0, 0, 0, 0.33);

        border: grey solid 1px;
    }

    .time {
        align-self: flex-end;
        float: right;
        color: grey;
        font-size: 10px;
    }

    i.fa-paper-plane {
        color: rgba(119, 64, 207, 1.0);
    }

    button[type=submit] {
        font-size: 25px;
        float: right;
        margin: 5px;
        border-radius: 100%;
        outline: none;
        border: none;
    }

    #secret {
        background-color: rgba(255, 255, 255, 1);
        display: none;
        height: 100vh;
        width: 100vw;
        position: fixed;
    }

    .options {
        background-color: #fb3b98;
        color: white;
        align-self: flex-end;
        float: right;
        border: none;
        padding: 8px;
        border-radius: 15px 15px 15px 15px;
        font-size: 15px;
        cursor: pointer;
        box-shadow: 2px 10px 21px 0px rgba(0, 0, 0, 0.33);
    }

    #pre-header {
        display: flex;
        flex-flow: column;
    }

    #logout {
        border-radius: 15px 15px 0px 0px;
        padding: 5px;
        background-color: rgba(0, 0, 0, 0.69);
        color: white;
        border: black solid 1px
    }

    .modal {
        display: none;
        width: 100vw;
        height: 100vh;
        position: fixed;
        background-color: rgba(0, 0, 0, 0.33);
        text-align: center;
    }

    .modal-content {
        font-size: 18px;
        max-width: 100vw;
        margin: auto;
        width: 350px;
        max-height: 100vh;
        overflow: auto;
        background-color: white;
        border-radius: 0px 0px 15px 15px;
        position: relative;
    }

    .close {
        border-radius: 0px 0px 15px 15px;
        margin: auto;
        background-color: royalblue;
        color: white;
        display: inline-block;
        padding-left: 10px;
        padding-right: 10px;
        cursor: pointer;
    }

    .list {
        border: #ececec solid 1px;
        position: relative;
    }

    .listOptions {
        text-align: left;
        padding: 5px;
        border: #ececec solid 1px;
        height: 40px;
        font-size: 18px;
        cursor: default;
    }

    .listOptions:hover {
        background-color: #ececec;
    }

    .listOptions.selected {
        background-color: royalblue !important;
    }

    @keyframes down {
        from {
            height: 0px;
        }

        to {
            height: 300px;
        }
    }

    @keyframes up {
        from {
            height: 300px;
        }

        to {
            height: 0px;
        }
    }

    @keyframes left {
        from {
            width: 0px;
        }

        to {
            width: 300px;
        }
    }

    @keyframes right {
        from {
            width: 300px;
        }

        to {
            width: 0px;
        }
    }

    #add_user {
        margin: 5px;
        color: white;
        padding: 10px;
        background-color: rgba(119, 64, 207, 1.0);
        border-radius: 100%;
        cursor: pointer;
        position: absolute;
        bottom: 10px;
        right: 10px;
    }

    .user2 {
        padding: 8px;
    }

    #new_user {
        width: 300px;
        display: none;
        border-radius: 10px 10px 10px 10px;
        border: black solid 1px;
        position: absolute;
        bottom: 9px;
        right: 10px;
        padding-top: 0px;
        padding-bottom: 0px;
    }

    #info_add_user {
        display: none;
    }

    .error-msg {
        color: #D8000C;
        background-color: #FFBABA;
    }

    .success-msg {
        color: #270;
        background-color: #DFF2BF;
    }
</style>

<body>
    <div class="modal" id="otherChats_div">
        <div class="modal-content" id="otherChats-content">
            <br />
            Other Chats
            <br /><br />
            <div class="list" id="list">


            </div>
            <input type="text" name="new_user" id="new_user" placeholder="Enter Username to add friend" />
            <i class="fa fa-user-plus" id="add_user" onclick="toggle_add()"></i>
            <div id="info_add_user" class="">
                <i class=""></i>
                Info
            </div>
        </div>
        <div class="close" id="close"><i style="color:white; font-size: 25px;" class="fa fa-chevron-up"></i></div>
    </div>
    <div id="secret"></div>
    <h1 class="center">Welcome <span class="name">Name</span></h1>

    <div class="container">
        <div id="pre-header">
            <button id="logout" class="options"><a href="logout.php" style="color:white"> Logout &times; </a></button>
        </div>
        <div class="header">
            <i class=" fa fa-user-circle fa-2x"></i>
            <span class="user2">User2</span>
            <button id="otherChats" class="options"> Other Chats</button>




        </div>
        <div id="chatPanel">
            <br /><br /><br /><br />
            <div class="msg">
                <div class="yourmsg">
                    Select friend from OtherChats Option.
                    <div class="time">
                        10:30
                    </div>
                </div>
            </div>
        </div>
        <div id="input_div">
            <form id="msg_form" method="POST" action="./send.php">
                <!-- <input type="text" name="msg" id="msg" autofocus autocomplete="off" placeholder="Type your msg"> -->
                <textarea name="msg" id="msg" autofocus autocomplete="off" placeholder="Type your msg"></textarea>
                <!--                 <input type="submit" name="submit" id="send" value="Send"> -->
                <button type="submit" name="submit" id="send" value="Send"><i class="fa fa-paper-plane"></i></button>
            </form>
        </div>

    </div>
    <script>
        function retrieve_list() {
            var xhr = new XMLHttpRequest();
            return new Promise(function(resolve) {
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        console.log(xhr.responseText);
                    }
                }
                xhr.open('post', './load_list.php');
                var formdata = new FormData();
                formdata.append('username', localStorage.getItem('username'));
                xhr.send(formdata);
            })
        }

        function make_list(list_array) {
            var l = document.getElementById('list');
            l.innerHTML = "";
            var json = JSON.parse(list_array);
            for (var i = 0; i < json.length; i++) {
                var new_listOption = document.createElement('div');
                new_listOption.className = "listOptions";
                var new_i = document.createElement('i');
                new_i.className = "fa fa-user-circle fa-2x";
                var new_span = document.createElement('span');
                new_span.className = "friends";
                new_span.innerText = json[i];
                new_listOption.append(new_i);
                new_listOption.append(new_span);
                l.append(new_listOption);
            }
        }

        function table_name() {
            var xhr = new XMLHttpRequest();
            return new Promise(function(resolve) {
                var formdata = new FormData();
                formdata.append('user1', localStorage.getItem('username'));
                formdata.append('user2', sessionStorage.getItem('user2'));
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        console.log(xhr.responseText);
                    }
                }
                xhr.open('post', './table_name.php');
                xhr.send(formdata);
            })
        }

        function load_msgs(tn) {
            var xhr = new XMLHttpRequest();
            return new Promise(function(resolve) {
                var formdata = new FormData();
                formdata.append('table_name', tn);
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        //console.log(xhr.responseText);
                    }
                }
                xhr.open('post', './load_msgs.php');
                xhr.send(formdata);
            })
        }

        function make_msg(from_user, to_user, msg, year, month, day, h, m, s) {
            var new_msg = document.createElement('div');
            new_msg.className = "msg";
            var new_mymsg = document.createElement('div');
            if (from_user == localStorage.getItem('username')) new_mymsg.className = "mymsg";
            else new_mymsg.className = "yourmsg";
            new_mymsg.innerText = msg;
            var new_time = document.createElement('div');
            new_time.className = "time";
            var date = day + "/" + month + "/" + year + "   " + h + ":" + m;
            new_time.innerText = date;
            new_mymsg.append(new_time);
            new_msg.append(new_mymsg);
            return new_msg;
        }

        function load() {
            table_name().then(function(x) {
                var json = JSON.parse(x.responseText);
                //console.log(json['table_name']);
                sessionStorage.setItem('tn', json['table_name']);
                load_msgs(json['table_name']).then(function(xhr) {
                    var json_msgs = JSON.parse(xhr.responseText);
                    chatPanel.innerHTML = "";
                    for (var i = 0; i < json_msgs.length; i++) {
                        chatPanel.append(make_msg(json_msgs[i].from_user, json_msgs[i].to_user, json_msgs[i].msg, json_msgs[i].year, json_msgs[i].month, json_msgs[i].day, json_msgs[i].hour, json_msgs[i].min, json_msgs[i].sec));
                        chatPanel.scrollTop = chatPanel.scrollHeight;

                    }
                })
            });

        }

        function load_list() {
            document.getElementById('list').innerHTML = "";
            document.getElementById('list').innerText = "";
            retrieve_list().then(function(x) {
                make_list(x.responseText)
            }).then(function() {
                Array.from(document.getElementsByClassName('listOptions')).forEach(function(element) {
                    element.addEventListener('click', function(e) {
                        var user2 = element.lastElementChild.innerText;
                        sessionStorage.setItem('user2', user2);
                        Array.from(document.getElementById('list').children).forEach(function(el) {
                            if (el.lastElementChild.innerText != sessionStorage.getItem('user2')) {
                                el.className = "listOptions";
                            } else {
                                element.classList.add('selected');
                            }
                        })
                        load();
                        modal.style.display = "none";
                        Array.from(document.getElementsByClassName('user2')).forEach(function(element) {
                            element.innerHTML = sessionStorage.getItem('user2');
                        })
                    })
                })
            });
        }

        function toggle_add() {
            var x = document.getElementById('add_user');
            x.classList.toggle('fa-chevron-circle-right');
            x.classList.toggle('fa-user-plus');
            if (x.classList == "fa fa-user-plus") {
                document.getElementById('new_user').style.animation = "right 800ms ease";
                setTimeout(function() {
                    document.getElementById('new_user').style.display = "none";
                }, 500);
                if (!(document.getElementById('new_user').value.trim() == "")) {
                    check_friend(document.getElementById('new_user').value);
                }
            } else {
                document.getElementById('new_user').style.animation = "left 800ms ease";
                document.getElementById('new_user').style.display = "block";
                document.getElementById('new_user').focus();
            }
        }

        function check_friend(new_friend) {
            var xhr = new XMLHttpRequest();
            var formdata = new FormData();
            formdata.append('new_friend', new_friend);
            formdata.append('username', localStorage.getItem('username'));
            return new Promise(function(resolve) {
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        var a = document.getElementById('info_add_user');
                        a.style.display = "block";
                        console.log(xhr.responseText);
                        if (xhr.responseText == "success") {
                            a.className = "success-msg";
                            a.childNodes[2].nodeValue="Successfully added friend.";
                            a.childNodes[1].className = "fa fa-check";
                            load_list();
                        } else {
                            a.className = "error-msg";
                            a.childNodes[1].className = "fa fa-times-circle";
                            a.childNodes[2].nodeValue=xhr.responseText;
                        }
                        setTimeout(function() {
                            a.style.display = "none";
                        }, 5000);
                    }
                }
                xhr.open('post', './check_friend.php');
                xhr.send(formdata);
            })
        }


        var modal = document.getElementById('otherChats_div');
        window.addEventListener('click', function(e) {
            if (e.target == modal)
                modal.style.display = "none";
        })
        document.getElementById('close').addEventListener('click', function() {

            document.getElementById('list').style.animation = "up 300ms ease"
            document.getElementById('list').style.height = "0px";
            setTimeout(function() {
                document.getElementById('otherChats_div').style.display = 'none';
            }, 300);
        })
        document.getElementById('otherChats').addEventListener('click', function() {
            var od = document.getElementById('otherChats_div');
            od.style.display = 'block';
            document.getElementById('list').style.animation = "down 500ms ease";
            document.getElementById('list').style.height = "300px";

        })
        window.onload = function() {
            var chatPanel = document.getElementById('chatPanel');
            sessionStorage.removeItem('user2');
            sessionStorage.removeItem('tn');
            localStorage.removeItem('user2');
            localStorage.removeItem('tn');
            //chatPanel.innerHTML = "";




            window.addEventListener('keydown', function(e) {
                if (e.which == "17" || e.key == "17") {
                    sessionStorage.setItem('secret', 1);
                    document.getElementById('secret').style.display = 'block';
                } else if (e.which == 16) {
                    sessionStorage.setItem('secret', 0);
                    document.getElementById('secret').style.display = 'none';
                } else if (e.which == 13 && e.shiftKey == false) {
                    var ta = document.getElementById('msg');
                    if (e.target == ta) {
                        document.getElementById('send').click();
                    }
                }
            });
            if (sessionStorage.getItem('secret') == 1) {
                var evt = new KeyboardEvent('keydown', {
                    'key': 17,
                    'which': 17
                });
                window.dispatchEvent(evt);
            }




            load_list();





            Array.from(document.getElementsByClassName('name')).forEach(function(element) {
                element.innerHTML = localStorage.getItem('name');
            })
            document.getElementById('msg').onchange = function() {
                if (document.getElementById('msg').value.trim() == '') {
                    document.getElementById('msg').setAttribute('placeholder', '');
                } else {
                    document.getElementById('msg').setAttribute('placeholder', 'Type your msg');
                }
            }
            chatPanel.scrollTop = chatPanel.scrollHeight;

            /* 
                    var ws=new WebSocket('ws://localhost/chat/send.php')
                    console.log(ws);
                    ws.onopen=function(){console.log('Connection Established')}; */


            function send_msg(msg, d) {
                var xhr = new XMLHttpRequest();
                var formdata = new FormData();
                formdata.append('table_name', sessionStorage.getItem('tn'));
                formdata.append('from_user', localStorage.getItem('username'));
                formdata.append('to_user', sessionStorage.getItem('user2'));
                formdata.append('msg', msg);
                formdata.append('msg', msg);
                formdata.append('day', d.getDate());
                formdata.append('month', eval(d.getMonth() + 1));
                formdata.append('year', d.getFullYear());
                formdata.append('h', d.getHours());
                formdata.append('m', d.getMinutes());
                formdata.append('s', d.getSeconds());
                formdata.append('submit', 'Send');
                return new Promise(function(resolve, reject) {
                    xhr.onreadystatechange = function() {
                        if (xhr.status >= 200 & xhr.status < 300) {
                            resolve(xhr);
                            //console.log(xhr.responseText);
                        }
                    }
                    xhr.open('post', './send.php');
                    xhr.send(formdata);
                })
            }






            document.getElementById('send').addEventListener('click', function() {
                var msg = document.getElementById('msg').value;
                if (msg.trim() == '') {
                    alert('Please enter text.');
                } else if (!sessionStorage.getItem('user2')) {
                    alert('Please select a friend to chat from Other Chats');
                } else {
                    var d = new Date();
                    chatPanel.append(make_msg(localStorage.getItem('username'), sessionStorage.getItem('user2'), msg, d.getFullYear(), eval(d.getMonth() + 1), d.getDate(), d.getHours(), d.getMinutes(), d.getSeconds()));
                    chatPanel.scrollTop = chatPanel.scrollHeight;
                    send_msg(msg, d).then(function() {
                        document.getElementById('msg').value = '';
                        document.getElementById('msg').setAttribute('placeholder', 'Type your msg');
                        //load_msgs();
                    })
                }
            })
            var form = document.getElementById('msg_form');
            form.onsubmit = function() {
                return false;
            }
            setInterval(function() {
                authenticate().then(function(xhr) {
                    if (xhr.responseText == "Invalid User") {
                        window.location.href = "login.php";
                    } else {
                        if (sessionStorage.getItem('tn')) load();
                    }
                })

            }, 5000);

            function authenticate() {
                var xhr = new XMLHttpRequest();
                return new Promise(function(resolve) {
                    var formdata = new FormData();
                    formdata.append('submit', 'check');
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
        }
    </script>
</body>

</html>

<?php
session_destroy();

?>