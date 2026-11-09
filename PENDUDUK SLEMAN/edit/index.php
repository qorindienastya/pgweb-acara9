<!DOCTYPE html>
<html>
<body>
<h2>Form Edit</h2>
<?php
    // Menyesuaikan dengan setting MySQL
    $servername = "localhost"; 
    $username   = "root";     
    $password   = "";          
    $dbname     = "latihan"; 

    // Membuat koneksi 
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi database
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $sql = "SELECT * FROM penduduk WHERE id = $id";
    $result  = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<form action='edit.php' onsubmit='return validateForm(event)' method='post'>";
            echo "<input type='hidden' name='id' value='".$row['id']."'><br>";
            echo "<label for='kecamatan'>Kecamatan:</label><br>";
            echo "<input type='text' id='kec' name='kecamatan' value='".$row['kecamatan']."'><br>";
            echo "<label for='longitude'>Longitude:</label><br>";
            echo "<input type='text' id='long' name='longitude' value='".$row['longitude']."'><br>";
            echo "<label for='latitude'>Latitude:</label><br>";
            echo "<input type='text' id='lat' name='latitude' value='".$row['latitude']."'><br>";
            echo "<label for='luas'>Luas:</label><br>";
            echo "<input type='text' id='luas' name='luas' value='".$row['luas']."'><br>";
            echo "<label for='jumlah_penduduk'>Jumlah Penduduk:</label><br>";
            echo "<input type='text' id='jml_pddk' name='jumlah_penduduk' value='".$row['jumlah_penduduk']."'><br><br>";
            echo "<input type='submit' value='Submit'>";
            echo "</form>";
        }
    }
    $conn->close();
?>

<p id="informasi"></p>

<script>
    function validateForm(e){
        let luas = document.getElementById("luas").value;
        let text = "";
        if (isNaN(luas) || luas < 1) {
            text = "Data luas harus angka dan tidak boleh bernilai negatif";
            document.getElementById("informasi").innerHTML = text;
            e.preventDefault(); // Menghentikan kirim HANYA jika luas tidak valid
            return false;
        }
        return true; // Lanjut kirim ke edit.php jika data valid
    }
</script>
</body>
</html>