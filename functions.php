<?php
    $conn = mysqli_connect('localhost','root','','phpdasar');

    function showData($Query){
        global $conn;
      
        $result = mysqli_query($conn,$Query);
        $students = [];
        while($student = mysqli_fetch_assoc($result)) {
            $students[] = $student;
        }
        return $students;
    }

    function insertData($data){
        global $conn;
        // htmlspecialchars berfungsi agar user tidak dapat menginput data berupa sintaks html
        $name = htmlspecialchars($data["name"]);
        $nrp = htmlspecialchars($data["nrp"]);
        $major = htmlspecialchars($data["jurusan"]);

        // image diambil after success uploaded file
        $gambar = uploadImage();
        // If uploaded image fail
        if(!$gambar) {
            // then not run insert data
            return false;
        }

        // after success uploaded file then we insert that data to database
        $insertDatas = "INSERT INTO mahasiswa VALUES (
            '','$name','$nrp','$major','$gambar'
            )";
        mysqli_query($conn,$insertDatas);
        // return > 0 if success or there is data changed and -1 if fail
        return mysqli_affected_rows($conn);
    }

    function deleteData($id){
        global $conn;
        $deleteDatas = "DELETE FROM mahasiswa WHERE id = $id";
        mysqli_query($conn,$deleteDatas);
        
        return mysqli_affected_rows($conn);
    }

    function updateData($dataUpdate){
        global $conn;
        $id = $dataUpdate["id"];
        $updateName = htmlspecialchars($dataUpdate["nama"]);
        $updateNrp = htmlspecialchars($dataUpdate["nrp"]);
        $updateMajors = htmlspecialchars($dataUpdate["jurusan"]);
        $oldIMage = htmlspecialchars($dataUpdate["oldImage"]);
        // if there is no new image uploaded or there is no file uploaded
        if($_FILES['gambar']['error'] === 4) {
            $updateImage = $oldIMage;
        } else {
            $updateImage = uploadImage();
        }
  
        $queryUpdateData = "UPDATE mahasiswa SET 
        nama = '$updateName', 
        nrp = '$updateNrp',
        jurusan = '$updateMajors',
        gambar = '$updateImage'
        WHERE id = $id
        " ;

        mysqli_query($conn,$queryUpdateData);
        return mysqli_affected_rows($conn);
    }

    function searchData($keyword){
        $dataSearch = 
        "SELECT * FROM mahasiswa WHERE 
        nama LIKE '%$keyword%' OR
        nrp LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%'
        ";
        return showData($dataSearch);
    }


    function uploadImage() {
        // imageName include type / extention
        $imageName = $_FILES["gambar"]["name"];
        $imageTempLocation = $_FILES["gambar"]["tmp_name"];
        // if error == 4 there is no file uploaded, check on the internet various of error
        $imageError = $_FILES["gambar"]["error"];
        // Size image satuannya byte
        $imageSize = $_FILES["gambar"]["size"];
        
        // if there is no file uploaded
        if($imageError === 4) {
            echo "
            <script>
                alert('You have to upload image');
            </script>       
           ";
           return false;
        }

        // if file uploaded not image
        $ValidimageExtention = ['jpg','jpeg','png'];
        // separate string file become array if there is dot symbol inside that file
        $imageExtention = explode('.', $imageName);
        // get last index and convert into lowerCase
        $imageExtention = strtolower(end($imageExtention));

        // needle is what user upload then compare into file extention that we've defined
        // the result is true or false.
        // true if there is same extention
        if(!in_array($imageExtention,$ValidimageExtention)){
            echo"
            <script>
                alert('File that you uploaded must be image extention \n such as jpg, jpeg or png');
            </script>       
           ";
           return false;
        }

        // Check size of image
        if($imageSize > 1000000) {
            echo "
            <script>
                alert('File uploaded must be less or at least 1 MB');
            </script>       
           ";
           return false;
        }

        // if user fullfill all condition then
        // file inside temp location ready to move into website folder
        // before insert to image name to database we have to generate new image name
        // in order to avoid other image with same name replaced
        // so we're using built in function that generate random value
        $newImageFileName = uniqid();
        $newImageFileName .= '.';
        $newImageFileName .= $imageExtention;

        move_uploaded_file($imageTempLocation,'img/' . $newImageFileName);
        return $newImageFileName;

    }


    function signup($userRegist){
        global $conn;
        // stripslashes = membersihkan backslash 
        // strtolower = membuat all of character lowercase
        $userName =  strtolower(stripslashes($userRegist["username"]));
        // realescapestring memungkinkan user memasukkan password ada tanda kutip dan akan dimasukkan kedalam databases
        $password = mysqli_real_escape_string($conn,$userRegist["password"]);
        $cPassword = mysqli_real_escape_string($conn,$userRegist["cPassword"]);
        

          // Jika ingin mengambil data dari database harus menggunakan built in function
          $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$userName'");
            $checkUsername = mysqli_fetch_assoc($result);
       
          if($checkUsername) {
              echo "
              <script>
              alert('Username tidak boleh sama');
              </script>
              ";
              return false;
          }


        if($password !== $cPassword) {
            echo "
            <script>   
            alert('Check again your password and confirm password !!! ');
        
            </script>
            ";
            return false;
        }

        // encrypt password
        $password = password_hash($password,PASSWORD_DEFAULT);
        
      
      

        $insertToDatabase = "INSERT INTO users values (
            '','$userName','$password')";
        mysqli_query($conn,$insertToDatabase);
        return mysqli_affected_rows($conn);
    }


    function login($dataUser) {
        global $conn;
        
        $username = $dataUser["username"];
        $password = $dataUser["password"];

        $queryUsername = "SELECT * FROM users
        WHERE username = '$username'";
        $result = mysqli_query($conn,$queryUsername);

        // return baris berdasarkan query ke database
        // Jika ketemu akan return 1, jika tidak ada = 0
        if(mysqli_num_rows($result) === 1) {

            // Cek password
            $row = mysqli_fetch_assoc($result);

            // password verify kebalikan dari password hash
            // cek sebuah string apakah sama dengan hash'nya
           if(password_verify($password, $row["password"])) { 
            // Set session   
            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
           }
        }
       
    }
      

    
?>