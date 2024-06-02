<?php
include 'config.php';

$sql = "SELECT * FROM barang";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }

        .table {
            background-color: #1e1e1e;
        }

        .form-control,
        .btn,
        .table,
        .modal-content {
            background-color: #333333;
            color: #ffffff;
            border: none;
        }

        .btn-primary {
            background-color: #6200ea;
        }

        .btn-danger {
            background-color: #b00020;
        }
    </style>
    <script>
        function generateKodeBarang() {
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0987654321';
            let kodeBarang = '';
            for (let i = 0; i < 5; i++) {
                kodeBarang += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            document.getElementById('kode_barang').value = kodeBarang;
        }

        window.onload = function () {
            generateKodeBarang();
        }
    </script>
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Data Barang</h2>

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
            Tambah Barang
        </button>

        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add New Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="create.php" method="POST">
                            <div class="mb-3">
                                <label for="kode_barang" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control fw-bold bg-transparent" readonly id="kode_barang"
                                    name="kode_barang">
                            </div>
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="satuan_barang" class="form-label">Satuan Barang</label>
                                <select class="form-control" id="satuan_barang" name="satuan_barang" required>
                                    <option value="kg">kg</option>
                                    <option value="pcs">pcs</option>
                                    <option value="liter">liter</option>
                                    <option value="meter">meter</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga_beli" class="form-label">Harga Beli</label>
                                <input type="number" class="form-control" id="harga_beli" name="harga_beli" step="0.01"
                                    required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="status_barang" name="status_barang">
                                <label class="form-check-label" for="status_barang">Active</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Satuan Barang</th>
                    <th>Harga Beli</th>
                    <th>Status Barang</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["kode_barang"] . "</td>";
                        echo "<td>" . $row["nama_barang"] . "</td>";
                        echo "<td>" . $row["jumlah_barang"] . "</td>";
                        echo "<td>" . $row["satuan_barang"] . "</td>";
                        echo "<td>" . $row["harga_beli"] . "</td>";
                        echo "<td>" . ($row["status_barang"] ? 'Active' : 'Inactive') . "</td>";
                        echo "<td>
                            <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#updateModal" . $row["id_barang"] . "'>Edit</button>
                            <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal" . $row["id_barang"] . "'>Delete</button>
                            <form action='update_quantity.php' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='id_barang' value='" . $row["id_barang"] . "'>
                                <input type='number' name='quantity_change' class='form-control d-inline-block' style='width: 100px;' required>
                                <button type='submit' class='btn btn-secondary btn-sm'>Update Quantity</button>
                            </form>
                          </td>";
                        echo "</tr>";

                        // Update Modal
                        echo "
                    <div class='modal fade' id='updateModal" . $row["id_barang"] . "' tabindex='-1' aria-labelledby='updateModalLabel" . $row["id_barang"] . "' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='updateModalLabel" . $row["id_barang"] . "'>Edit Barang</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <form action='update.php' method='POST'>
                                        <input type='hidden' name='id_barang' value='" . $row["id_barang"] . "'>
                                        <div class='mb-3'>
                                            <label for='kode_barang' class='form-label'>Kode Barang</label>
                                            <input type='text' class='form-control fw-bold bg-transparent' id='kode_barang' readonly name='kode_barang' value='" . $row["kode_barang"] . "' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='nama_barang' class='form-label'>Nama Barang</label>
                                            <input type='text' class='form-control' id='nama_barang' name='nama_barang' value='" . $row["nama_barang"] . "' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='jumlah_barang' class='form-label'>Jumlah Barang</label>
                                            <input type='number' class='form-control' id='jumlah_barang' name='jumlah_barang' value='" . $row["jumlah_barang"] . "' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='satuan_barang' class='form-label'>Satuan Barang</label>
                                            <select class='form-control' id='satuan_barang' name='satuan_barang' required>
                                                <option value='kg'" . ($row["satuan_barang"] == 'kg' ? ' selected' : '') . ">kg</option>
                                                <option value='pcs'" . ($row["satuan_barang"] == 'pcs' ? ' selected' : '') . ">pcs</option>
                                                <option value='liter'" . ($row["satuan_barang"] == 'liter' ? ' selected' : '') . ">liter</option>
                                                <option value='meter'" . ($row["satuan_barang"] == 'meter' ? ' selected' : '') . ">meter</option>
                                            </select>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='harga_beli' class='form-label'>Harga Beli</label>
                                            <input type='number' class='form-control' id='harga_beli' name='harga_beli' step='0.01' value='" . $row["harga_beli"] . "' required>
                                        </div>
                                        <div class='mb-3 form-check'>
                                            <input type='checkbox' class='form-check-input' id='status_barang' name='status_barang'" . ($row["status_barang"] ? ' checked' : '') . ">
                                            <label class='form-check-label' for='status_barang'>Active</label>
                                        </div>
                                        <button type='submit' class='btn btn-primary'>Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>";

                        // Delete Modal
                        echo "
                    <div class='modal fade' id='deleteModal" . $row["id_barang"] . "' tabindex='-1' aria-labelledby='deleteModalLabel" . $row["id_barang"] . "' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='deleteModalLabel" . $row["id_barang"] . "'>Delete Barang</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <p>Are you sure you want to delete this item?</p>
                                </div>
                                <div class='modal-footer'>
                                    <form action='delete.php' method='POST'>
                                        <input type='hidden' name='id_barang' value='" . $row["id_barang"] . "'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                        <button type='submit' class='btn btn-danger'>Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No results found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>