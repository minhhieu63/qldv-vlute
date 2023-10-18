<?php
include "conn.php";
$maKhoa = $_POST['maKhoa'];

// Thực hiện xóa Khoa dựa trên $maKhoa
$sql = "DELETE FROM taikhoan WHERE MaTaiKhoan = '$maKhoa'";
$response = array();

if (mysqli_query($conn, $sql)) {
    $response["success"] = true;
} else {
    $response["success"] = false;
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($response);
?>
