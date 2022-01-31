<?php 
    require_once('./functions.php');
    $conn = mysqli_connect('localhost','root','','phpdasar');
    $userId = $_GET["name"];
    $queryShowData = "SELECT * from mahasiswa WHERE id = {$userId}";
    // Langsung me-return array index ke 0
    $students = showData($queryShowData)[0];
   


    if(isset($_POST['submit'])) {
           if(updateData($_POST) > 0){
            echo"
            <script>
                alert('Data successfully added');
                document.location.href = 'index.php';
            </script>
           ";
           } else {
            echo"
            <script>
                alert('Please check your connection or sql syntax');
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
    <title>Update data</title>

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        div {
            margin-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="./css/update.css">
</head>
<body>

<header style="padding:10px; background-color:bisque; margin-bottom:30px;">
    <div>
      <h1>
          UPDATE DATA
      </h1>
    </div>
</header>
    
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <input hidden type="text" name="id" value="<?php echo $students['id'] ?>" required> 
            </div>
            <div>
                <input hidden type="text" name="oldImage" value="<?php echo $students['gambar'] ?>" required> 
            </div>
      
            <div>
                <input type="text" name="nama" value="<?php echo $students['nama'] ?>" required> 
            </div>
            <div>
                <input type="text" name="nrp" value="<?php echo $students['nrp'] ?>" required> 
            </div>
            <div>
                <input type="text" name="jurusan" value="<?php echo $students['jurusan'] ?>" required> 
            </div>

            <div>
                <img src="./img/<?php echo $students['gambar'] ?>">

                <input type="file" name="gambar"> 
            </div>
            <div>
                <button type="submit" name="submit">update data</button>
            </div>
       
        </form>

</body>
</html>