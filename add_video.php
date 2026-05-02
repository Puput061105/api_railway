<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include "koneksi.php";

$title = $_POST['title'] ?? '';
$folderThumb = "uploads/thumbnail/";
$folderVideo = "uploads/video/";

if (!file_exists($folderThumb)) mkdir($folderThumb, 0777, true);
if (!file_exists($folderVideo)) mkdir($folderVideo, 0777, true);

$thumbnailExt = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
$videoExt = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);

$thumbnailName = time() . "." . $thumbnailExt;
$videoName = time() . "." . $videoExt;

move_uploaded_file($_FILES['thumbnail']['tmp_name'], $folderThumb . $thumbnailName);
move_uploaded_file($_FILES['video']['tmp_name'], $folderVideo . $videoName);

$query = "INSERT INTO youtube (title, thumbnail, videos) VALUES ('$title', '$thumbnailName', '$videoName')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo json_encode(["success" => true, "message" => "Berhasil upload"]);
} else {
    echo json_encode(["success" => false, "message" => mysqli_error($koneksi)]);
}
?>