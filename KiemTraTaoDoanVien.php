<?php 
session_start(); 
include "conn.php";
if (isset($_POST['MaLop']) && isset($_POST['MSSV']) && isset($_POST['TenDangNhap']) && isset($_POST['MaTaiKhoan']) && isset($_POST['MatKhau'])) {

	$MaLop = validate($_POST['MaLop']);
    $MaTaiKhoan = validate($_POST['MaTaiKhoan']);
    $MSSV = validate($_POST['MSSV']);
    $TenDangNhap = validate($_POST['TenDangNhap']);
	$MatKhau = validate($_POST['MatKhau']);
    $Email=validate($_POST['Email']);

    $sql="SELECT * FROM lop WHERE MaLop='$MaLop' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $MaSoLop=$row['MaSoLop'];

	if (empty($MaLop)) {
		header("Location: TaoDoanVien.php?error=Chưa chọn lớp !");
	    exit();
	}
	else if(empty($MaTaiKhoan)){
        header("Location: TaoDoanVien.php?error=Chưa nhập mã đoàn viên!");
	    exit();
	}
    else if(substr($MaTaiKhoan,0,2)!='DV' || !is_numeric(substr($MaTaiKhoan,2)) ){
        header("Location: TaoDoanVien.php?error=Mã đoàn viên phải bắt đầu 'DV' và kết thúc bằng một số !");
	    exit();
	}
    else if(empty($MSSV) ){
        header("Location: TaoDoanVien.php?error=Chưa nhập mã số sinh viên !");
	    exit();
	}
    else if(strlen($MSSV)!=8 || !is_numeric($MSSV)){
        header("Location: TaoDoanVien.php?error=MSSV phải bao gồm 8 chữ số, nếu đầy hãy chọn lớp khác !");
	    exit();
	}
    else if(substr($MSSV,0,6)!=$MaSoLop ){
        header("Location: TaoDoanVien.php?error=MSSV không khớp với mã lớp !");
	    exit();
	}
    else if(empty($MatKhau) ){
        header("Location: TaoDoanVien.php?error=Chưa nhập mật khẩu !");
	    exit();
	}
    else{
        // Kiểm tra DV này tồn tại hay chưa
        $sql="SELECT * FROM taikhoan WHERE MaTaiKhoan='$MaTaiKhoan' || MSSV='$MSSV'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            header("Location: TaoDoanVien.php?error=Mã đoàn viên hoặc MSSV đã được sử dụng !");
	        exit();
        }
        else{
        // Tìm khoa
        $sql="SELECT * FROM lop WHERE MaLop='$MaLop' ";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $MaKhoa=$row['MaKhoa'];
        // chèn
        $sql="INSERT INTO taikhoan(MaTaiKhoan,TenDangNhap,MatKhau,Quyen,MaKhoa,MaLop,MSSV,Email) 
                VALUES ('$MaTaiKhoan','$TenDangNhap','$MatKhau','Đoàn viên','$MaKhoa','$MaLop','$MSSV','$Email')";
        $result=mysqli_query($conn,$sql);
        if($result){
            header("Location: TaoDoanVien.php?success=Thêm đoàn viên thành công!");
            exit();
        }
        else{
            header("Location: TaoDoanVien.php?error=Thêm đoàn viên khoa thất bại!");
            exit();
        }}
        
	}
}else{
	header("Location: TaoDoanVien.php");
	exit();
}