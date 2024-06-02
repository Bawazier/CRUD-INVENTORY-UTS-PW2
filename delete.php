<?php
    include 'config.php';

    $id_barang = $_POST['id_barang'];

    $sql = "DELETE FROM barang WHERE id_barang='$id_barang'";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
