<?php
include "conn.php"; 
// Lây ma tk
$maLop = $_POST['maLop'];

// Tìm mã lớp của đoàn viên này
$sql = "SELECT MaLop from taikhoan WHERE MaTaiKhoan = '$maLop'";
$result = mysqli_query($conn, $sql);
$mlcuadv=mysqli_fetch_assoc($result)['MaLop'];
// Tìm đoàn viên nào trong lớp đó có chức vụ là Bí thư lớp thì trả lại làm Đoàn viên
$sql="UPDATE taikhoan 
                SET Quyen='Đoàn viên' where MaLop='$mlcuadv' and Quyen='Bí thư lớp'";
$result=mysqli_query($conn,$sql);
// Set dv có mã tài khoản đc chọn thành quyền Bí thư lớp
$sql="UPDATE taikhoan 
                SET Quyen='Bí thư lớp' where MaLop='$mlcuadv' and MaTaiKhoan='$maLop'";
$result=mysqli_query($conn,$sql);

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
