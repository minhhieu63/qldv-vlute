<?php
include"conn.php";

$selectedValue = $_POST['selectedValue'];
$data = array();
if ($selectedValue!=null){
  $sql = "SELECT MaLop, TenLop, NamVaoHoc,ThuTuLop FROM lop WHERE MaKhoa = '$selectedValue'";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
}
mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($data);

?>