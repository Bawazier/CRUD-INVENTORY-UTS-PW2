<?php
    include 'config.php';

    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan_barang = $_POST['satuan_barang'];
    $harga_beli = $_POST['harga_beli'];
    $status_barang = isset($_POST['status_barang']) ? 1 : 0;

    $sql = "INSERT INTO barang (kode_barang, nama_barang, jumlah_barang, satuan_barang, harga_beli, status_barang)
    VALUES ('$kode_barang', '$nama_barang', '$jumlah_barang', '$satuan_barang', '$harga_beli', '$status_barang')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();