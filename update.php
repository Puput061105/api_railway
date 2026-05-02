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
$title = $_POST['title'];

$folderThumb = "uploads/thumbnail/";
$folderVideo = "uploads/video/";

if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
    $thumbnailName = time() . "." . pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['thumbnail']['tmp_name'], $folderThumb . $thumbnailName);
    $thumbField = ", thumbnail = '$thumbnailName'";
} else {
    $thumbField = "";
}

if (isset($_FILES['video']) && $_FILES['video']['error'] === 0) {
    $videoName = time() . "." . pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['video']['tmp_name'], $folderVideo . $videoName);
    $videoField = ", videos = '$videoName'";
} else {
    $videoField = "";
}

$query = "UPDATE youtube SET title = '$title' $thumbField $videoField WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo json_encode(["success" => true, "message" => "Berhasil diupdate"]);
} else {
    echo json_encode(["success" => false, "message" => mysqli_error($koneksi)]);
}
?>