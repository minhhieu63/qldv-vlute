<?php 
session_start(); 
include "conn.php";

if (isset($_POST['TenDangNhap']) && isset($_POST['MatKhau'])) {

	$TenDangNhap = validate($_POST['TenDangNhap']);
	$MatKhau = validate($_POST['MatKhau']);

	if (empty($TenDangNhap)) {
		header("Location: index.php?error=Chưa nhập tên đăng nhập!");
	    exit();
	}else if(empty($MatKhau)){
        header("Location: index.php?error=Chưa nhập mật khẩu!");
	    exit();
	}else{
        // Tìm tài khoản
		$sql = "SELECT * FROM taikhoan WHERE TenDangNhap='$TenDangNhap' ";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            // Nếu đúng mật khẩu
            if ($row['MatKhau'] === $MatKhau) {
                // Lưu thông tin cho trang phân loại
				
                // Đóng kết nối
                mysqli_close($conn);
            	if($row['Quyen']==='Bí thư trường'){
					$_SESSION= $row;
                    header("Location: TaoKhoa.php");
		            exit();
                }
                else if($row['Quyen']==='Bí thư khoa'){
					$_SESSION= $row;
                    header("Location: BauBiThuLop.php");
		            exit();
                }
                else if($row['Quyen']==='Bí thư lớp'){
					$_SESSION= $row;
                    header("Location: ThongTinDoanVien.php");
		            exit();
                }
                else{
					$_SESSION= $row;
                    header("Location: ThongTinDoanVien.php");
		            exit();
                }
            }else{
                // Nếu sai mật khẩu
				header("Location: index.php?error=Mật khẩu không chính xác!");
		        exit();
			}
		}else{
			header("Location: index.php?error=Tài khoản không tồn tại!");
	        exit();
		}
	}
}else{
	header("Location: index.php");
	exit();
}