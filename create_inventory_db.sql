-- Create the database
CREATE DATABASE IF NOT EXISTS id22246586_inventory;

-- Use the database
USE id22246586_inventory;

-- Create the table 'barang'
CREATE TABLE IF NOT EXISTS barang (
    id_barang INT(10) AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(20) NOT NULL,
    nama_barang VARCHAR(50) NOT NULL,
    jumlah_barang INT(10) NOT NULL,
    satuan_barang VARCHAR(20) NOT NULL CHECK (satuan_barang IN ('kg', 'pcs', 'liter', 'meter')),
    harga_beli DOUBLE(20, 2) NOT NULL,
    status_barang BOOLEAN NOT NULL
);
