<?php
    include 'config.php';

    $id_barang = $_POST['id_barang'];
    $quantity_change = $_POST['quantity_change'];

    $sql = "SELECT jumlah_barang FROM barang WHERE id_barang='$id_barang'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_quantity = $row['jumlah_barang'] + $quantity_change;

        $update_sql = "UPDATE barang SET jumlah_barang='$new_quantity' WHERE id_barang='$id_barang'";

        if ($conn->query($update_sql) === TRUE) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error updating quantity: " . $conn->error;
        }
    } else {
        echo "No record found with id_barang = $id_barang";
    }

    $conn->close();