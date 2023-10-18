<?php
include "conn.php"; 

$maLop = $_POST['maLop'];

// Thực hiện xóa lớp dựa trên $maLop
$sql = "DELETE FROM taikhoan WHERE MaTaiKhoan = '$maLop'";
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
