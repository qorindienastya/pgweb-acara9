<?php
    $id=$_GET['id'];

    $servername = "localhost"; 
    $username   = "root";     
    $password   = "";          
    $dbname     = "latihan";  

    // Membuat koneksi database
    $conn=new mysqli($servername, $username, $password, $dbname);
    
    // Memeriksa koneksi database
    if($conn->connect_error){
        die("Connection failed:".$conn->connect_error);
    }

    // Menghapus dengan DELETE FROM nama table WHERE kondisi
    $sql="DELETE FROM penduduk WHERE id=$id";

    if($conn->query($sql)===TRUE){
        echo "Record with id=$id deleted successfully";
    }else {
        echo"Error:".$sql. "<br>" .$conn->error;
    }

    $conn->close();
    header("Location: index.php");
?>