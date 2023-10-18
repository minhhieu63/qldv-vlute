<?php
include"conn.php";

$selectedValue = $_POST['selectedValue'];
$data = array();
if ($selectedValue!=null){
  $sql = "SELECT * FROM taikhoan WHERE MaLop = '$selectedValue' and (Quyen='Đoàn viên' or Quyen='Bí thư lớp') order by MSSV";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
}
mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($data);

?>