<?php
include 'connection.php';

function addSales($nama, $perusahaan, $alamat) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO data_sales (nama, perusahaan, alamat) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $perusahaan, $alamat);
    return $stmt->execute();
}

function getAllSales() {
    global $conn;
    $sql = "SELECT * FROM data_sales";
    $result = $conn->query($sql);
    $sales = [];
    while($row = $result->fetch_assoc()) {
        $sales[] = $row;
    }
    return $sales;
}

function getSalesById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM data_sales WHERE id_sales = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateSales($id, $nama, $perusahaan, $alamat) {
    global $conn;
    $stmt = $conn->prepare("UPDATE data_sales SET nama=?, perusahaan=?, alamat=? WHERE id_sales=?");
    $stmt->bind_param("sssi", $nama, $perusahaan, $alamat, $id);
    return $stmt->execute();
}

function deleteSales($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM data_sales WHERE id_sales=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>
