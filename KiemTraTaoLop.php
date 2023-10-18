<?php 
session_start(); 
include "conn.php";
if (isset($_POST['MaKhoaTenKhoa']) && isset($_POST['NamVaoHoc'])) {

	$MaKhoa = validate(substr($_POST['MaKhoaTenKhoa'], 0, 3));
    $TenKhoa= validate(substr($_POST['MaKhoaTenKhoa'],3));
	$NamVaoHoc = validate($_POST['NamVaoHoc']);
    $ThuTuLop=validate($_POST['ThuTuLop']);
    $MaLop=validate($_POST['MaLop']);
    $TenLop=validate($_POST['TenLop']);

	if (empty($MaKhoa)) {
		header("Location: TaoLop.php?error=Chưa chọn khoa !");
	    exit();
	}
    else if(empty($NamVaoHoc)){
        header("Location: TaoLop.php?error=Chưa nhập năm vào học !");
	    exit();
	}
    else if(strlen($NamVaoHoc)!=4 || !is_numeric($NamVaoHoc)){
        header("Location: TaoLop.php?error=Nhập năm là một số có 4 chữ số !");
	    exit();
	}
    else if(empty($ThuTuLop)){
        header("Location: TaoLop.php?error=Chưa nhập thứ tự lớp vào học !");
	    exit();
	}
    else if(!is_numeric($ThuTuLop)){
        header("Location: TaoLop.php?error=Nhập thứ tự lớp là một số !");
	    exit();
	}
    else{
        $sql="SELECT * FROM lop WHERE MaLop='$MaLop'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            header("Location: TaoLop.php?error=Mã lớp đã tồn tại, hãy chọn mã khác !");
	        exit();
        }
        else{
            $sql="SELECT MaSoKhoa FROM khoa WHERE MaKhoa='$MaKhoa'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $MaSoLop=substr($NamVaoHoc, 2, 2).$row['MaSoKhoa'].($ThuTuLop-1);

            $sql="INSERT INTO lop VALUES ('$MaLop','$TenLop','$NamVaoHoc','$ThuTuLop','$MaSoLop','$MaKhoa')";
            $result=mysqli_query($conn,$sql);
            // Đóng kết nối
            $conn->close();
            if($result){
                header("Location: TaoLop.php?success=Thêm lớp thành công!");
                exit();
            }
            else{
                header("Location: TaoLop.php?error=Thêm lớp không thành công!");
                exit();
            }     
        }   
	}
}else{
	header("Location: TaoLop.php");
	exit();
}