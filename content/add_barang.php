<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Memeriksa apakah semua input form diisi
    if (isset($_POST['namaBarang'], $_POST['supplier'], $_POST['stock'], $_POST['hargaSales'], $_POST['hargaToko'], $_POST['hargaOnline'], $_POST['hargaKompetitor']) && isset($_FILES['gambar'])) {
        $namaBarang = $_POST['namaBarang'];
        $supplierId = $_POST['supplier'];
        $stock = $_POST['stock'];
        $hargaSales = $_POST['hargaSales'];
        $hargaToko = $_POST['hargaToko'];
        $hargaOnline = $_POST['hargaOnline'];
        $hargaKompetitor = $_POST['hargaKompetitor'];
        $tanggalMasuk = $_POST['tanggalMasuk'];

        // Mengambil nama supplier berdasarkan ID
        try {
            $stmt = $pdo->prepare("SELECT nama FROM data_sales WHERE id_sales = ?");
            $stmt->execute([$supplierId]);
            $supplierRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($supplierRow) {
                $supplierName = $supplierRow['nama'];
            } else {
                echo "Supplier not found.";
                exit;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }

        // Mengunggah file gambar dengan versioning
        $targetDir = "uploads/";
        $originalFileName = pathinfo($_FILES["gambar"]["name"], PATHINFO_FILENAME);
        $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
        $timestamp = time();
        $targetFile = $targetDir . $originalFileName . '_' . $timestamp . '.' . $imageFileType;

        $uploadOk = 1;

        // Memeriksa apakah file adalah gambar sebenarnya
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Memeriksa ukuran file
        if ($_FILES["gambar"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Memeriksa format file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Memeriksa apakah $uploadOk ditetapkan menjadi 0 karena kesalahan
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
                // Menyimpan data ke database
                try {
                    $stmt = $pdo->prepare("INSERT INTO barang (namaBarang, supplier, stock, hargaSales, hargaToko, hargaOnline, hargaKompetitor, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$namaBarang, $supplierName, $stock, $hargaSales, $hargaToko, $hargaOnline, $hargaKompetitor, basename($targetFile)]);
                    echo "<script>alert('Data berhasil disimpan.'); window.location='../dashboard/master_barang.php';</script>";
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "All form fields must be filled out.";
    }
}
?>
