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
        $insertDatas = "INSERT INTO mahasiswa VALUES (
            '','$name','$nrp','$major','NULL'
            )";
        mysqli_query($conn,$insertDatas);
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

        $queryUpdateData = "UPDATE mahasiswa SET 
        nama = '$updateName', 
        nrp = '$updateNrp',
        jurusan = '$updateMajors' 
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

?>