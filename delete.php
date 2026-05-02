<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include "koneksi.php";

$id = $_POST['id'];
$query = "DELETE FROM youtube WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo json_encode(["success" => true, "message" => "Berhasil dihapus"]);
} else {
    echo json_encode(["success" => false, "message" => mysqli_error($koneksi)]);
}
?>