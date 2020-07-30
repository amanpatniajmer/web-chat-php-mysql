<?php
session_start();
if (isset($_COOKIE['authorize'])) {
    if ($_COOKIE['authorize'] == true)
        header("location: index.php");
    else {
        echo "cookie";
    }
} else {
    echo "Please LogIn";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Login</title>
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
            background-color: rgba(119, 64, 207, 1.0);
            border: none;
            color: white;
            font-size: 16px;
        }

        a:visited {
            color: blue;
        }

        .center {
            text-align: center;
        }

        .error-msg {
            color: #D8000C;
            background-color: #FFBABA;
            padding: 5px;
        }

        .success-msg {
            padding: 5px;
            color: #270;
            background-color: #DFF2BF;
        }

        #info {
            display: none;
        }
    </style>
</head>

<body>
    <h1 class="center">Login into App</h1>
    <form id="login_form" action="validate_login.php" method="post">
        <label>Username:
            <input id="username" name="username" type="text" required />
        </label>
        <label>Password:
            <input id="password" type="password" name="password" required />
        </label>
        <label>
            <input type="checkbox" style="width:auto" onclick="togglePass()">
            Show Password
        </label>
        <span id="info" class=""><i class=""></i>Info</span>
        <input type="submit" name="submit" id='login_btn' value="Login" /><br /><br />
        <span class="center"><a href="signup.php">Create a new account</a></span>
    </form>


    <script>
        function togglePass() {
            var a = document.getElementById('password');
            if (a.type == "password") a.type = "text";
            else a.type = "password";
        }
        var info = document.getElementById('info');
        document.getElementById('login_form').onsubmit = function() {
            return false;
        }
        document.getElementById('login_btn').addEventListener('click', function() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            authenticate(username, password).then(function(xhr) {
                var res = JSON.parse(xhr.responseText);
                if (res.name != "") {
                    info.style.display = "block";
                    info.className = "success-msg";
                    info.firstChild.className = "fa fa-check";
                    info.childNodes[1].nodeValue = "Successfully logged in. Redirecting...";
                    localStorage.setItem('name', res.name);
                    localStorage.setItem('username', res.username);
                    window.location.href = "index.php";
                } else {
                    info.style.display = "block";
                    info.className = "error-msg";
                    info.firstChild.className = "fa fa-times-circle";
                    info.childNodes[1].nodeValue = res.message;
                }
                setTimeout(function() {
                    info.style.display = "none";
                }, 5000);

            })
        })

        function authenticate(username, password) {
            var xhr = new XMLHttpRequest();
            return new Promise(function(resolve) {
                var formdata = new FormData();
                formdata.append('username', username);
                formdata.append('password', password);
                formdata.append('submit', 'login');
                xhr.onreadystatechange = function() {
                    if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                        resolve(xhr);

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