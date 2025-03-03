<?php
include '../content/addmodal_barang.php';
include '../action/edit/modal_edit.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Persediaan Barang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the layout */
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px;
            text-align: left;
            font-size: 18px;
            display: block;
            color: #333;
        }
        .sidebar a:hover {
            background-color: #ddd;
            color: #000;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .summary-card {
            text-align: center;
            color: #fff;
            padding: 20px;
        }
        .summary-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .summary-card i {
            font-size: 2em;
        }
        .summary-card .card-title {
            margin-top: 10px;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="text-center mb-4">
            <img src="https://via.placeholder.com/80" alt="Admin" class="rounded-circle">
            <h4>Administrator</h4>
        </div>
        <a href="../index.php"><i class="fas fa-home"></i> Home</a>
        <a href="master_barang.php"  id="masterDataButton">
            <i class="fas fa-box"></i> Master Data Barang
        </a>
        <a href="barang_keluar.php"><i class="fas fa-exchange-alt"></i> Data Barang Keluar</a>
        <a href="data_sales.php"><i class="fas fa-truck"></i> Data Supplier</a>
        <a href="../login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>selamat datang di dashboard aplikasi stock barang</h2>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>Data Barang</div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="padding: 2px 20px;">Add</button>
            </div>
            <div class="card-body">
            <?php
require '../connection.php';

// Mengambil data dari database
try {
    $stmt = $pdo->query("SELECT * FROM barang");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die(); // Menghentikan eksekusi jika terjadi kesalahan
}
?>

<table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Supplier</th>
            <th>Stock</th>
            <th>Harga Supplier</th>
            <th>Harga Toko</th>
            <th>Harga Online</th>
            <th>Harga Kompetitor</th>
            <th>Tanggal Masuk</th>
            <th>Aksi</th>
            <!-- <th>Gambar</th> -->
        </tr>
    </thead>
    <tbody>
        <?php 
         $index = 1;
        foreach ($rows as $row): ?>
        <tr>
            <td><?php echo $index++; ?></td>
            <td><?php echo htmlspecialchars($row['namaBarang']); ?></td>
            <td><?php echo htmlspecialchars($row['supplier']); ?></td>
            <td><?php echo htmlspecialchars($row['stock']); ?></td>
            <td><?php echo htmlspecialchars($row['hargaSales']); ?></td>
            <td><?php echo htmlspecialchars($row['hargaToko']); ?></td>
            <td><?php echo htmlspecialchars($row['hargaOnline']); ?></td>
            <td><?php echo htmlspecialchars($row['hargaKompetitor']); ?></td>  
            <td><?php echo htmlspecialchars($row['tanggalMasuk']); ?></td>        
            <td>
            <div class="btn-group" role="group">
                    <a href="#" class="btn btn-primary btn-sm edit-btn mr-2" data-id="<?php echo $row['id_barang']; ?>" data-toggle="modal" data-target="#editModal">Edit</a>
                    <a href="../action/hapus_barang.php?id=<?php echo $row['id_barang']; ?>" class="btn btn-danger btn-sm">Delete</a>
            </div>
            </td>
            <!-- <td>
                <?php if (!empty($row['gambar'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar Barang" style="max-width: 100px; max-height: 100px;">
                <?php else: ?>
                    No Image
                <?php endif; ?>
            </td> -->
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
