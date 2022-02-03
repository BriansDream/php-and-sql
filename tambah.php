<?php
require_once('./functions.php');
session_start();
if(!$_SESSION["login"]) {
    header("Location: login.php");
    exit;
}
if(isset($_POST["submit"])) {
    
   if(insertData($_POST) > 0) {
       echo"
        <script>
            alert('Data successfully added');
            document.location.href = 'index.php';
        </script>
       ";
   } else {
       echo"
        <script>
            alert('Failed added data please check your connection or SQL sintaks');
            document.location.href = 'index.php';
        </script>       
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
    <title>Add Data</title>
    <link rel="stylesheet" href="./add.css">
</head>
<body>
    <header>
        <div>
            Add data
        </div>
    </header>

    <main>
        <div id="content">
            <!-- enctype / encoding type, untuk menangani file -->
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <input type="text" name="name" placeholder="Name of mahasiswa" required>
                </div>
                <div>
                    <input type="text" name="nrp" placeholder="Nim mahasiswa" required>
                </div>
                <div>
                    <input type="text" name="jurusan" placeholder="Jurusan" required>
                </div>
                <div>
                    <input type="file" name="gambar">
                </div>
                <div>
                  <input class="btn-add" type="submit" name="submit" value="send">
                </div>
            </form>

        <div class="container-back" style="margin-top:30px;">
            <a href="./index.php" style="text-decoration:none;">
                    <h1>Back to admin page</h1>
            </a>
        </div>
        </div>
    </main>
</body>
</html>