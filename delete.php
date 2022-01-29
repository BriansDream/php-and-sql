<?php 
require_once('./functions.php');
   $id = $_GET["name"];
   if(deleteData($id) > 0) {
        echo 
        "
        <script>
        alert('Data deleted successfully');
        document.location.href = 'index.php';
        </script>
        ";
   } else {
    echo 
    "
    <script>
    alert('please check your connection or sql syntax');
    document.location.href = 'index.php';
    </script>
    ";
   }

?>