<?php
    $servername = "localhost"; 
    $username   = "root";     
    $password   = "";          
    $dbname     = "tps_magelang";

   // 2. Membuat koneksi baru ke database menggunakan library MySQLi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 3. Memeriksa status koneksi database
    if ($conn->connect_error){
        // Jika koneksi gagal, hentikan program dan tampilkan pesan error
        die("Connection failed: " . $conn->connect_error);
    }

    // 4. Menyusun query SQL untuk mengambil seluruh data dari tabel 'tps'
    $sql = "SELECT * FROM tps"; 
    
    // Mengeksekusi query SQL dan menyimpan hasilnya ke variabel $result
    $result = $conn->query($sql);

    // 5. Menampilkan tombol/link menuju formulir tambah data
    echo "<a href='input/index.html'>Input</a><br><br>";

    // 6. Mengecek apakah query berhasil dan data di dalam tabel lebih dari 0 baris
    if ($result && $result->num_rows > 0){
        
        // Inisialisasi variabel $no untuk penomoran urut di tabel
        $no = 1;

        // Mencetak struktur header/judul kolom tabel HTML
        echo "<table border='2' cellpadding='8' cellspacing='0'>
            <tr>
                <th>No</th>
                <th>Nama TPS</th>
                <th>Kategori</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Tahun Berdiri</th>
                <th>Alamat</th>
                <th colspan='2'>Aksi</th>
            </tr>";

        // 7. Looping data: Mengambil baris demi baris data dari database sebagai array asosiatif
        while($row = $result->fetch_assoc()){
            echo "<tr>
                <td>".$no++."</td>                          <!-- Menampilkan nomor urut otomatis -->
                <td>".$row["Nama TPS"]."</td>               <!-- Menampilkan nama TPS -->
                <td>".$row["Kategori"]."</td>               <!-- Menampilkan kategori TPS -->
                <td>".$row["Latitude"]."</td>               <!-- Menampilkan koordinat Latitude -->
                <td>".$row["Longitude"]."</td>              <!-- Menampilkan koordinat Longitude -->
                <td>".$row["Tahun Berdiri"]."</td>          <!-- Menampilkan tahun berdiri -->
                <td>".$row["Alamat"]."</td>                 <!-- Menampilkan alamat lengkap -->
                
                <!-- Tombol aksi hapus dengan mengirimkan ID data via URL -->
                <td><a href='delete.php?id=".$row["id"]."'>hapus</a></td>
                
                <!-- Tombol aksi edit mengarah ke subfolder 'edit' dengan mengirimkan ID -->
                <td><a href='edit/index.php?id=".$row["id"]."'>edit</a></td>
            </tr>";
        }
        
        // Menutup tag tabel setelah semua baris selesai ditampilkan
        echo "</table>";
    } else {
        // Tampilan alternatif jika belum ada data sama sekali di database
        echo "0 results";
    }

    // 8. Menutup koneksi database untuk menghemat memori server
    $conn->close();
?>