
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>

<script>
    var username=localStorage.getItem('username')
    localStorage.removeItem('name');
    localStorage.removeItem('username');
    function logout(){
    var xhr = new XMLHttpRequest();
                return new Promise(function(resolve) {
                    var formdata = new FormData();
                    formdata.append('submit', 'logout');
                    formdata.append('username',username);
                    formdata.append('status',0);
                    xhr.onreadystatechange = function() {
                        if (xhr.status >= 200 & xhr.status < 300 & xhr.readyState == 4) {
                            resolve(xhr);
                            if(xhr.responseText)
                                window.location.href="./login.php";
                        }
                    }
                    xhr.open('post', './validate_login.php');
                    xhr.send(formdata);
        })
        }
        logout();
    
    </script>
    </html>
<?php

?>