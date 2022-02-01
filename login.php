<?php 
    require_once('./functions.php');
    if(isset($_POST['login'])) {
        if(!login($_POST)) {
            echo"
            <script>
            alert('please check your password');
            </script
            ";
       
        }
    
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        form div {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<header style="padding:10px; background-color:yellow;">
    <div>
        <h1>Login menu</h1>
    </div>
</header>

<main>
    <div id="content">

        <form action="" method="post" style="margin: 10px;">
                <div>
                    <input style="padding:10px; font-size:1.3rem;" type="text" placeholder="input your username" name="username">
                </div>

                <div>
                    <input style="padding:10px; font-size:1.3rem;"  type="password" placeholder="input your password" name="password">
                </div>

                <div>
                    <button type="submit" name="login" style="padding:10px; font-size:1.3rem;">login</button>
                </div>
        </form>
  
    </div>
</main>
    
</body>
</html>