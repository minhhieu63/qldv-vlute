<?php 
session_start(); 
include "conn.php";
if (isset($_POST['MaKhoa']) && isset($_POST['HoVaTen']) && isset($_POST['TenDangNhap']) && isset($_POST['MaTaiKhoan']) && isset($_POST['MatKhau']) &&isset($_POST['Email'])) {

	$MaKhoa = validate($_POST['MaKhoa']);
    $HoVaTen = validate($_POST['HoVaTen']);
    $MaTaiKhoan = validate($_POST['MaTaiKhoan']);
    $TenDangNhap = validate($_POST['TenDangNhap']);
	$MatKhau = validate($_POST['MatKhau']);
    $Email=validate($_POST['Email']);

	if (empty($MaKhoa)) {
		header("Location: TaoBiThuKhoa.php?error=Chưa chọn khoa !");
	    exit();
	}
    else if(empty($HoVaTen)){
        header("Location: TaoBiThuKhoa.php?error=Chưa nhập họ và tên bí thư !");
	    exit();
	}else if(empty($MatKhau)){
        header("Location: TaoBiThuKhoa.php?error=Chưa nhập mật khẩu!");
	    exit();
	}
    else if(empty($Email)){
        header("Location: TaoBiThuKhoa.php?error=Chưa nhập email!");
	    exit();
	}
    else{
        // tìm mã btk tồn tại hay chưa
        $sql="SELECT * FROM taikhoan WHERE MaTaiKhoan='$MaTaiKhoan'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result)>0){
            header("Location: TaoBiThuKhoa.php?error=Khoa này đã có bí thư khoa !");
            exit();
        }
        else{
            $sql="INSERT INTO taikhoan(MaTaiKhoan,TenDangNhap,MatKhau,Quyen,MaKhoa,HoVaTen, Email) 
                VALUES ('$MaTaiKhoan','$TenDangNhap','$MatKhau','Bí thư khoa','$MaKhoa','$HoVaTen','$Email')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: TaoBiThuKhoa.php?success=Thêm bí thư khoa thành công !");
                    exit();
                }
                else{
                    header("Location: TaoBiThuKhoa.php?error=Thêm bí thư khoa thất bại !");
                    exit();
                }
        }
	}
}else{
	header("Location: TaoBiThuKhoa.php");
	exit();
}