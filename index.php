<?php
    require_once('./functions.php');
    session_start();
    if(!$_SESSION["login"]) {
        header("Location: login.php");
        exit;
    }
    $Query = "SELECT * FROM mahasiswa";
    $datas = showData($Query);
  
    if(isset($_POST["cari"])) {
        $datas = searchData($_POST["keyword"]);
        
      
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of students</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>

<header>
    <div class="container title">
        <h1>List of students</h1>
    </div>
</header>

<main>
    <div id="content">

    <section style="margin-bottom: 10px; display:flex; justify-content:space-between;">
            <form action="" method="POST" >
                <input type="text" name="keyword" placeholder="cari apa nih...?" autocomplete="off" autofocus>
                <button type="submit" name="cari">Cari</button>
            </form>

            <a href="./logout.php?name=<?php echo $_SESSION["login"]?> style="text-decoration: none;">
         <div>
             <p style="color:red;">Logout dulu gaes...</p>
         </div>
            </a>

    </section>

    <table>
            <thead>
                <th>No</th>
                <th>NIM</th>
                <th>Name</th>
                <th>Jurusan</th>
                <Th>Picture</Th>
                <th>Action</th>
            </thead>
            <tbody>
        <?php $i=1; ?>
   
        <?php foreach($datas as $data): ?>
                <tr>
                        <td>
        <?php echo $i ?>
                        </td>
               
                        <td>
        <?php echo $data["nama"] ?>
                        </td>
               
                        <td>
        <?php echo $data["nrp"] ?>
                        </td>
                
                        <td>
        <?php echo $data["jurusan"] ?>
                        </td>
               
                        <td>
       <img src="./img/<?php echo $data["gambar"] ?>" alt=""> 
                        </td>
                        <td>
                    <a href="./tambah.php">
                        <button type="submit" class="add-data" value="add">add</button>
                    </a>
                    <a href="./updateData.php?name=<?php echo $data["id"] ?>">
                        <button type="submit" class="update-data">update</button>
                    </a>
                    <a href="delete.php?name=<?php echo $data["id"] ?>" onclick="return confirm('are u sure want to delete this data?')">
                        <button type="submit" class="delete-data" name="submit" >delete</button>
                        
                        </a>
                    </td>
                </tr>
<?php $i++;?>
<?php endforeach ?>



            </tbody>
    </table>

    </div>
</main>
    
</body>
</html>