<?php
    // 1. Menyimpan konfigurasi parameter untuk koneksi ke MySQL server
    $servername = "localhost"; 
    $username   = "root";     
    $password   = "";          
    $dbname     = "latihan";   

    // 2. Inisialisasi objek koneksi baru menggunakan class mysqli
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 3. Memeriksa apakah terjadi kesalahan saat menyambungkan ke database
    if ($conn->connect_error){
        // Jika gagal, hentikan eksekusi program dan tampilkan pesan error
        die("Connection failed: " . $conn->connect_error);
    }

    // 4. Menyusun query SQL untuk mengambil seluruh data dari tabel 'penduduk'
    $sql = "SELECT * FROM penduduk";
    
    // Mengeksekusi query dan menyimpan hasilnya ke dalam variabel $result
    $result = $conn->query($sql);

    // 5. Mencetak link navigasi menuju form input HTML di dalam folder 'input'
    echo "<a href='input/index.html'>Input</a><br><br>";

    // 6. Mengecek apakah jumlah baris data hasil query lebih dari 0
    if ($result->num_rows > 0){
        // Mencetak bagian header/judul kolom tabel HTML dengan padding 8px
        echo "<table border='2' cellpadding='8' cellspacing='0'>
            <tr>
                <th>ID</th>
                <th>Kecamatan</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Luas</th>
                <th>Jumlah Penduduk</th>
                <th colspan='2'>Aksi</th>
            </tr>";

        // 7. Looping data: mengambil satu baris data sebagai array asosiatif hingga habis
        while($row = $result->fetch_assoc()){
            // Mencetak baris tabel baru untuk setiap data yang ditemukan di database
            echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["kecamatan"]."</td>
                <td>".$row["longitude"]."</td>
                <td>".$row["latitude"]."</td>
                <td>".$row["luas"]."</td>
                <td align='right'>".$row["jumlah_penduduk"]."</td>
                <td><a href=delete.php?id=".$row["id"].">hapus</a></td>
                <td><a href=edit/index.php?id=".$row["id"].">edit</a></td>
            </tr>";
        }
        
        // Menutup tag tabel setelah semua data selesai di-looping
        echo "</table>";
    } else {
        // Tampilan alternatif jika tabel di database belum berisi data
        echo "0 results";
    }

    // 8. Menutup jalur koneksi ke database untuk menghemat sumber daya server
    $conn->close();
?>