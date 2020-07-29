<?php
session_start();
/* if(isset($_COOKIE['authorize'])){
    if($_COOKIE['authorize']==true)
    header("location: index.php");
    else{
        echo "cookie";
    }
}
else{
    echo "Please LogIn";
} */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        * {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        form {
            background-color: #ececec;
            width: 350px;
            margin: auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 2px 10px 21px 0px rgba(0, 0, 0, 0.33);
        }

        input {
            width: 100%;
            margin: 5px 0px;
            padding: 8px 0px;
        }

        input[type=submit] {
            background-color: royalblue;
            border: none;
            color: white;
            font-size: 16px;

        }

        .center {
            text-align: center;
        }

        .error-msg {
            color: #D8000C;
            background-color: #FFBABA;
            padding:5px;
        }

        .success-msg {
            padding:5px;
            color: #270;
            background-color: #DFF2BF;
        }
        #info{
            display: none;
        }
    </style>
</head>

<body>
    <h1 class="center">Sign Up</h1>
    <form id="signup_form" action="validate_login.php" method="post">
        <label>Name:
            <input id="name" name="name" type="text" required />
        </label>
        <label>Username:
            <input id="username" name="username" type="text" required />
        </label>
        <label>Password:
            <input id="password" type="password" name="password" required />
        </label>
        <span id="info" class=""><i class=""></i>Info</span>
        <input type="submit" name="submit" id="signup_btn" value="SignUp" />
        <span class="center"><a href="login.php">Already have an account? Login.</a></span>
    </form>
    <script>
        var info = document.getElementById('info');
        document.getElementById('signup_form').onsubmit = function() {
            return false;
        }
        document.getElementById('signup_btn').addEventListener('click', function() {
            var name = document.getElementById('name').value;
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            register(name, username, password).then(function(xhr) {
                //info.innerText = xhr.responseText;
            })
        })

        function register(name, username, password) {
            var xhr = new XMLHttpRequest();
            return new Promise(function(resolve) {
                var formdata = new FormData();
                formdata.append('name', name);
                formdata.append('username', username);
                formdata.append('password', password);
                formdata.append('submit', 'SignUp');
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);
                        console.log(xhr.responseText);
                        if (xhr.responseText == "success") {
                            info.style.display = "block";
                            info.className = "success-msg";
                            var t=document.createTextNode("Successfully created a new account. Please login by the following link.");
                            info.firstChild.className = "fa fa-check";
                            info.append(t);
                        } else {
                            info.style.display = "block";
                            info.className = "error-msg";
                            info.firstChild.className = "fa fa-times-circle";
                            info.childNodes[1].nodeValue=xhr.responseText;
                        }
                        setTimeout(function() {
                            info.style.display = "none";
                        }, 5000);
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