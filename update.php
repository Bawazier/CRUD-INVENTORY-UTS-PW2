<?php
    include 'config.php';

    $id_barang = $_POST['id_barang'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan_barang = $_POST['satuan_barang'];
    $harga_beli = $_POST['harga_beli'];
    $status_barang = isset($_POST['status_barang']) ? 1 : 0;

    $sql = "UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', jumlah_barang='$jumlah_barang', satuan_barang='$satuan_barang', harga_beli='$harga_beli', status_barang='$status_barang' WHERE id_barang='$id_barang'";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();