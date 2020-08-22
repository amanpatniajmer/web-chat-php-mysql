<?php
session_start();
if (!isset($_COOKIE['authorize']) or $_COOKIE['authorize']==-10) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Chat</title>
    <link rel="manifest" href="./manifest.json">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<style>
    * {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        text-align: justify;
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
        position: relative;
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
        height: calc(100vh - 280px);
        display: flex;
        align-items: flex-end;
        flex-flow: column;
        padding: 5px;
        overflow: auto;
        position: relative;
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
        height: 40px;
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
        flex-direction: column;
    }

    .mymsg {
        color: black;
        max-width: 80%;
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
        max-width: 80%;
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
        color: hsl(0deg 0% 0% / 61%);
        font-size: 10px;
    }

    i.fa-paper-plane {
        color: rgba(119, 64, 207, 1.0);
    }

    button[type=submit] {
        font-size: 25px;
        position: absolute;
        float: right;
        margin: 5px;
        border-radius: 100%;
        outline: none;
        border: none;
        background-color: rgba(0, 0, 0, 0);
    }

    #secret {
        background-color: rgba(255, 255, 255, 1);
        display: none;
        height: 100vh;
        width: 100vw;
        position: fixed;
        z-index: 10000;
    }

    .options {
        background-color: rgb(80 47 152);
        color: white;
        align-self: flex-end;
        float: right;
        border: none;
        padding: 8px;
        border-radius: 15px 15px 15px 15px;
        font-size: 15px;
        cursor: pointer;
        box-shadow: -2px 2px 1px 3px rgb(0 0 0 / 14%);
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
        visibility: hidden;
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.33);
        text-align: center;
        z-index: 1000;
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

    #scroller {
        float: right;
        position: relative;
        bottom: 110px;
        color: green;
        background-color: white;
        padding: 8px;
        margin-bottom: 5px;
        right: 8px;
        border-radius: 100%;
        box-shadow: -3px 3px 3px 1px rgba(0, 0, 0, 0.69);
        z-index: 500;
    }

    #scroller_div {
        visibility: hidden;
    }

    #status_icon {
        border-radius: 100%;
        box-shadow: -3px 3px 3px 1px rgba(0, 0, 0, 0.69);
    }

    #status_div {
        /* background-color: rgb(80 47 152); */
        color: white;
        border: none;
        padding: 0px;
        font-size: 12px;
        /* border-radius: 15px 15px 15px 15px; */
        /* box-shadow: -2px 2px 1px 3px rgb(0 0 0 / 14%); */
    }

    .date {
        padding: 2px;
        width: 50px;
        align-self: center;
        background-color: rgb(225, 243, 251);
        display: inline-block;
        color: black;
        text-align: center;
        box-shadow: 5px 8px 6px 1px rgba(0, 0, 0, 0.33);
        border-radius: 8px;
    }

    @media only screen and (max-width: 385px) {
        #status {
            visibility: hidden;
        }
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
            <i class=" fa fa-user-circle fa-2x" id="avatar"></i>
            <span class="user2">User2</span>
            <span id="status_div">
                <i id="status_icon" class="fa fa-eercast offline"></i>
                <span class="status" id="status">Status</span>
            </span>
            <button id="otherChats" class="options"> Other Chats</button>
        </div>
        <div id="chatPanel">
            <br /><br /><br /><br />
            <div class="msg">
                <div class="date">
                    Today
                </div>
            </div>
            <div class="msg">
                <div class="yourmsg">
                    Select friend from OtherChats Option.
                </div>
            </div>
        </div>

        <div id="input_div">
            <form id="msg_form" method="POST" action="./support/send.php">
                <!-- <div>
                <button name="link" id="link"><i class="fa fa-link"></i></button>
            </div> -->
                <textarea name="msg" id="msg" autofocus autocomplete="off" placeholder="Type your msg"></textarea>
                <button type="submit" name="submit" id="send" value="Send"><i class="fa fa-paper-plane"></i></button>
            </form>
        </div>
        <div id="scroller_div"><i class="fa fa-hand-o-down fa-2x" id="scroller"></i></div>
    </div>
    <script>
        var counter = 0;
        var prevloaded;

        function retrieve_list() {
            var xhr = new XMLHttpRequest();
            return new Promise(function(resolve) {
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        //console.log(xhr.responseText);
                    }
                }
                xhr.open('post', './support/load_list.php');
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
                        //console.log(xhr.responseText);
                    }
                }
                xhr.open('post', './support/table_name.php');
                xhr.send(formdata);
            })
        }

        function load_msgs(tn) {
            var xhr = new XMLHttpRequest();
            return new Promise(function(resolve) {
                var formdata = new FormData();
                formdata.append('table_name', tn);
                formdata.append('username', sessionStorage.getItem('user2'));
                formdata.append('submit', 'initial');
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        //console.log(xhr.responseText);
                    }
                }
                xhr.open('post', './support/load_msgs.php');
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

        function partial_load() {
            var xhr = new XMLHttpRequest();
            var formdata = new FormData();
            var d = new Date(sessionStorage.getItem('llt'));
            formdata.append('table_name', sessionStorage.getItem('tn'));
            formdata.append('username', sessionStorage.getItem('user2'));
            formdata.append('day', d.getDate());
            formdata.append('month', eval(d.getMonth() + 1));
            formdata.append('year', d.getFullYear());
            formdata.append('h', d.getHours());
            formdata.append('m', d.getMinutes());
            formdata.append('s', d.getSeconds());
            formdata.append('id', sessionStorage.getItem('llid'));
            formdata.append('submit', 'partial');
            return new Promise(function(resolve, reject) {
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        //console.log("Partial:" + xhr.responseText);
                    }
                }
                xhr.open('post', './support/load_msgs.php');
                xhr.send(formdata);
            })
        }

        function update_status(json_msgs) {
            if (json_msgs[0].status == 1) {
                document.getElementById('status_icon').style.color = "yellowgreen";
                document.getElementById('status').innerText = "Online";
            } else {
                document.getElementById('status_icon').style.color = "red";
                document.getElementById('status').innerText = "Offline";
            }
        }

        function load() {
            table_name().then(function(x) {
                var json = JSON.parse(x.responseText);
                sessionStorage.setItem('tn', json['table_name']);
                var json_msgs;
                //console.log(counter);
                if (counter != 0) {
                    if (prevloaded == 1) {
                        prevloaded = 0;
                        partial_load().then(function(xhr) {
                            json_msgs = JSON.parse(xhr.responseText);
                            update_status(json_msgs);
                            if (json_msgs.length > 1) sessionStorage.setItem('llid', json_msgs[json_msgs.length - 1].id);
                            append_msgs(json_msgs);
                            prevloaded = 1;
                        })
                    }
                } else {
                    counter++;
                    load_msgs(json['table_name']).then(function(xhr) {
                        json_msgs = JSON.parse(xhr.responseText);
                        update_status(json_msgs);
                        if (json_msgs.length > 1) sessionStorage.setItem('llid', json_msgs[json_msgs.length - 1].id);
                        append_msgs(json_msgs);
                        prevloaded = 1;
                    })
                }
            });
        }

        function append_msgs(json_msgs) {
            //console.log(json_msgs);
            //console.log(new Date(Date.parse(json_msgs[0])));
            /* console.log(new Date(Date.parse(json_msgs[0])).getMilliseconds()); */
            /* sessionStorage.setItem('llt', new Date(Date.parse(json_msgs[0]))); */
            if (chatPanel.scrollHeight - chatPanel.clientHeight - chatPanel.scrollTop < 110) {
                sessionStorage.setItem('load', 1);
            } else {
                if (json_msgs.length > 1) {
                    //alert('hey');
                    document.getElementById('scroller_div').style.visibility = "visible";
                }
            }
            //if(!sessionStorage.getItem('llt')) 
            //one message of 48.6 height
            for (var i = 1; i < json_msgs.length; i++) {
                chatPanel.append(make_msg(json_msgs[i].from_user, json_msgs[i].to_user, json_msgs[i].msg, json_msgs[i].year, json_msgs[i].month, json_msgs[i].day, json_msgs[i].hour, json_msgs[i].min, json_msgs[i].sec));
                if (sessionStorage.getItem('load') == 1) {
                    chatPanel.scrollTop = chatPanel.scrollHeight;
                }
            }
            sessionStorage.removeItem('load');
        }
        function authenticate() {
                var xhr = new XMLHttpRequest();
                return new Promise(function(resolve) {
                    var formdata = new FormData();
                    formdata.append('submit', 'check');
                    formdata.append('username', localStorage.getItem('username'));
                    if (document.hasFocus()) {
                        formdata.append('status', 1);
                    } else formdata.append('status', 0);
                    xhr.onreadystatechange = function() {
                        if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                            resolve(xhr);
                            //console.log(xhr.responseText);
                        }
                    }
                    xhr.open('post', './support/validate_login.php');
                    xhr.send(formdata);
                })
            }
        function load_list() {
            document.getElementById('list').innerHTML = "";
            document.getElementById('list').innerText = "";
            authenticate().then(function(xhr) {
                if (xhr.responseText == "Invalid User") {
                    window.location.href = "login.php";
                } else {
                    retrieve_list().then(function(x) {
                        make_list(x.responseText)
                    }).then(function() {
                        Array.from(document.getElementsByClassName('listOptions')).forEach(function(element) {
                            element.addEventListener('click', function(e) {
                                counter = 0;
                                var user2 = element.lastElementChild.innerText;
                                sessionStorage.setItem('user2', user2);
                                Array.from(document.getElementById('list').children).forEach(function(el) {
                                    if (el.lastElementChild.innerText != sessionStorage.getItem('user2')) {
                                        el.className = "listOptions";
                                    } else {
                                        element.classList.add('selected');
                                        chatPanel.innerHTML = "";
                                    }
                                })
                                sessionStorage.removeItem('llid');
                                load();
                                modal.style.visibility = "hidden";
                                Array.from(document.getElementsByClassName('user2')).forEach(function(element) {
                                    element.innerHTML = sessionStorage.getItem('user2');
                                })
                            })
                        })
                    });
                }
            })
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
                        //console.log(xhr.responseText);
                        if (xhr.responseText == "success") {
                            a.className = "success-msg";
                            a.childNodes[2].nodeValue = "Successfully added friend.";
                            a.childNodes[1].className = "fa fa-check";
                            load_list();
                        } else {
                            a.className = "error-msg";
                            a.childNodes[1].className = "fa fa-times-circle";
                            a.childNodes[2].nodeValue = xhr.responseText;
                        }
                        setTimeout(function() {
                            a.style.display = "none";
                        }, 5000);
                    }
                }
                xhr.open('post', './support/check_friend.php');
                xhr.send(formdata);
            })
        }


        var modal = document.getElementById('otherChats_div');
        window.addEventListener('click', function(e) {
            if (e.target == modal)
                //modal.style.display = "none";
                modal.style.visibility = "hidden";
        })
        document.getElementById('close').addEventListener('click', function() {

            document.getElementById('list').style.animation = "up 300ms ease"
            document.getElementById('list').style.height = "0px";
            setTimeout(function() {
                //document.getElementById('otherChats_div').style.display = 'none';
                modal.style.visibility = "hidden";
            }, 300);
        })
        document.getElementById('otherChats').addEventListener('click', function() {
            load_list();
            var od = document.getElementById('otherChats_div');
            //modal.style.display = 'block';
            modal.style.visibility = "visible";
            document.getElementById('list').style.animation = "down 500ms ease";
            document.getElementById('list').style.height = "300px";

        })
        if ('serviceWorker' in window.navigator) {
            //console.log('a');
            /* window.addEventListener('load',function(){
                window.navigator.serviceWorker.register('./sw.js')
                .then(function(){console.log('Successfully registered')})
                .catch(function(){console.log('Error!')})
            }) */

        }
        window.onload = function() {


            /* var deferredPrompt;
            var btnAdd = document.getElementById('btnAdd');
            window.addEventListener('beforeinstallprompt', e => {
                e.preventDefault();
                console.log("Before install trigerred");
                deferredPrompt = e;
                btnAdd.style.display = "block";
            });

            btnAdd.addEventListener("click", (e) => {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log("User accepted the prompt");
                        btnAdd.style.display="none";
                    }
                    deferredPrompt = null;
                })
            }); */
            var chatPanel = document.getElementById('chatPanel');
            document.getElementById('scroller_div').addEventListener('click', function() {
                chatPanel.scrollTop = chatPanel.scrollHeight;
                document.getElementById('scroller_div').style.visibility = "hidden";
            })
            sessionStorage.removeItem('user2');
            sessionStorage.removeItem('tn');
            sessionStorage.removeItem('llid');
            sessionStorage.setItem('load', 1);
            //chatPanel.innerHTML = "";

            document.getElementById('avatar').addEventListener('click', function() {
                document.getElementById('secret').style.display = 'block';
                document.getElementsByClassName('fa fa-paper-plane')[0].style.display = "none";
            })


            window.addEventListener('keydown', function(e) {
                if (e.which == "17" || e.key == "17") {
                    sessionStorage.setItem('secret', 1);
                    document.getElementById('secret').style.display = 'block';
                    document.getElementsByClassName('fa fa-paper-plane')[0].style.display = "none";
                } else if (e.which == 16) {
                    sessionStorage.setItem('secret', 0);
                    document.getElementById('secret').style.display = 'none';
                    document.getElementsByClassName('fa fa-paper-plane')[0].style.display = "block";
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
                    xhr.open('post', './support/send.php');
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
                        document.getElementById('msg').setAttribute('placeholder', 'Type your msg');
                        //load_msgs();
                    })
                }
            })
            var form = document.getElementById('msg_form');
            form.onsubmit = function() {
                document.getElementById('msg').value = '';
                form.reset();
                return false;
            }
            setInterval(function() {
                authenticate().then(function(xhr) {
                    if (xhr.responseText == "Invalid User") {
                        window.location.href = "login.php";
                    } else {
                        if (sessionStorage.getItem('tn')) {
                            load();
                        }
                    }
                })

            }, 3000);
        }
    </script>
</body>

</html>

<?php
session_destroy();

?>