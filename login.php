<?php
session_start();
if(isset($_COOKIE['authorize'])){
    if($_COOKIE['authorize']==true)
    header("location: index.php");
    else{
        echo "cookie";
    }
}
else{
    echo "Please LogIn";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        *{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        form{
            background-color: #ececec;
            width: 350px;
            margin: auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 2px 10px 21px 0px rgba(0,0,0,0.33);
        }
        input{
            width: 100%;
            margin: 5px 0px;
            padding: 8px 0px;
        }
        input[type=submit]{
            background-color: royalblue;
            border: none;
            color: white;
            font-size: 16px;
            
        }
        .center{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 class="center">Login into App</h1>
    <form id="login_form" action="validate_login.php" method="post">
        <label>Username:
            <input id="username" name="username" type="text" required/>
        </label>
        <label>Password:
        <input id="password" type="password" name="password" required/>
        </label>
        <span id="info"></span>
        <input type="submit" name="submit" id='login_btn' value="Login"/>
        <span class="center"><a href="signup.php">Create a new account</a></span>
    </form>


    <script>
        var info=document.getElementById('info');
        document.getElementById('login_form').onsubmit=function(){
            return false;
        }
        document.getElementById('login_btn').addEventListener('click',function(){
            var username=document.getElementById('username').value;
            var password=document.getElementById('password').value;
            authenticate(username,password).then(function(xhr){
                var res=  JSON.parse(xhr.responseText);
                if(res.name==''){info.innerHTML=res.message;}
                else{
                    console.log(xhr);
                    localStorage.setItem('name',res.name);
                    localStorage.setItem('username',res.username);
                    window.location.href="index.php";
                }})
        })
        function authenticate(username,password) {
            var xhr = new XMLHttpRequest();
            return new Promise(function(resolve) {
                var formdata= new FormData();
                formdata.append('username',username);
                formdata.append('password',password);
                formdata.append('submit','login');
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        console.log(xhr);
                        
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