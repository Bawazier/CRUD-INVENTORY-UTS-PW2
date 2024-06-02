<?php
    include 'config.php';

    $sql = "SELECT * FROM barang";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id_barang"]. " - Kode: " . $row["kode_barang"]. " - Nama: " . $row["nama_barang"]. " - Jumlah: " . $row["jumlah_barang"]. " - Satuan: " . $row["satuan_barang"]. " - Harga: " . $row["harga_beli"]. " - Status: " . ($row["status_barang"] ? 'Active' : 'Inactive') . "<br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();