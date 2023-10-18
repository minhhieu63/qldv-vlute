<?php
include "conn.php";
$sql = "SELECT * FROM khoa,taikhoan WHERE Quyen='Bí thư khoa' and khoa.MaKhoa=taikhoan.MaKhoa";
$result = mysqli_query($conn, $sql);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
mysqli_close($conn);
header('Content-Type: application/json');
echo json_encode($data);
?>
