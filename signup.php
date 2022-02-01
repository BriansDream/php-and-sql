<?php 
    require_once('./functions.php');
if(isset($_POST['register'])) {
    if(signup($_POST) > 0) {
        echo "<script>
        alert('Registrasi berhasil...');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        section div {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <header style="padding:10px; background-color:red; margin-botton:30px;">
    <div>
        <h1 style="color:white">Sign up menu</h1>
    </div>
    </header>


    <main>
    <div id="content">

    <section style="padding:10px;">
        <form action="" method="post">

        <div>
            <input name="username" style="padding:10px; font-size:1.5rem" type="text" placeholder="please input your username..." required maxlength="20">
        </div>
        <div>
            <input name="password" style="padding:10px; font-size:1.5rem" type="password" placeholder="please input your password..." required maxlength="20">
        </div>
        <div>
            <input name="cPassword" style="padding:10px; font-size:1.5rem" type="password" placeholder="confirm password" required maxlength="20">
        </div>
        <div>
            <button type="submit" name="register" style="padding:10px; font-size: 1.5rem;">signup</button>
        </div>
        </form>
    </section>


    </div>
    </main>

    
</body>
</html>