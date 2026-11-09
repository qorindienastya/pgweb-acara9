<?php
    // 1. Menangkap data yang dikirimkan dari form (index.html) melalui metode POST
    // Nama di dalam [''] harus sama dengan atribut 'name' pada tag <input> HTML
    $kecamatan       = $_POST['kecamatan'];
    $longitude       = $_POST['longitude'];
    $latitude        = $_POST['latitude'];
    $luas            = $_POST['luas'];
    $jumlah_penduduk = $_POST['jumlah_penduduk'];

    // 2. Menyiapkan parameter konfigurasi koneksi ke MySQL
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "latihan";

    // 3. Membuka koneksi baru ke database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Mengecek apakah koneksi database berhasil
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 4. Menyusun query SQL INSERT INTO untuk memasukkan data baru ke tabel 'penduduk'
    $sql = "INSERT INTO penduduk (kecamatan, longitude, latitude, luas, jumlah_penduduk)
            VALUES ('$kecamatan', '$longitude', '$latitude', '$luas', '$jumlah_penduduk')";

    // 5. Eksekusi query dan cek keberhasilannya
    if ($conn->query($sql) === TRUE) {
        // Tampilkan pesan sukses ke layar (tanpa redirect)
        echo "New record created successfully";
        $conn->close();
    } else {
        // Jika gagal simpan, tampilkan pesan error SQL
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
    }
?>