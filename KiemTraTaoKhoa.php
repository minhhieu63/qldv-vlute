<?php 
session_start(); 
include "conn.php";

if (isset($_POST['MaKhoa']) && isset($_POST['TenKhoa']) && isset($_POST['MaSoKhoa'])) {

	$MaKhoa = validate($_POST['MaKhoa']);
	$TenKhoa = validate($_POST['TenKhoa']);
	$MaSoKhoa = validate($_POST['MaSoKhoa']);

	if (empty($MaKhoa)) {
		header("Location: TaoKhoa.php?error=Chưa nhập mã khoa!");
	    exit();
	}if (empty($MaSoKhoa)) {
		header("Location: TaoKhoa.php?error=Chưa nhập mã số khoa!");
	    exit();
	}else if(empty($TenKhoa)){
        header("Location: TaoKhoa.php?error=Chưa nhập tên khoa!");
	    exit();
	}else{
		$sql = "SELECT * FROM khoa WHERE MaKhoa='$MaKhoa' OR MaSoKhoa='$MaSoKhoa' OR TenKhoa='$TenKhoa' ";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) >0) {
			header("Location: TaoKhoa.php?error=Mã khoa, mã số khoa hoặc tên khoa đã tồn tại!");
	        exit();
		}else{
			$sql = "INSERT INTO khoa VALUES ('$MaKhoa','$MaSoKhoa','$TenKhoa') ";
            $result=mysqli_query($conn, $sql);
            if($result){
                header("Location: TaoKhoa.php?success=Thêm khoa thành công!");
	            exit();
            }
		}
        mysqli_close($conn);
	}
	
}else{
	header("Location: TaoKhoa.php");
	exit();
}