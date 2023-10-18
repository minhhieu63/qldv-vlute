<div class="header">
<p><font size="4px" color="#28ee2b">ĐOÀN KHOA CÔNG NGHỆ THÔNG TIN</font></p>
<p><font size="5" color="#fff">HỆ THỐNG QUẢN LÍ THÔNG TIN ĐOÀN VIÊN VÀ ĐOÀN PHÍ</font></p>
<p><font size="3px" color="#fff">TRANG DÀNH CHO 
<?php 
        if($_SESSION['Quyen']=="Bí thư trường") 
            echo mb_strtoupper($_SESSION['Quyen'], 'UTF-8').' VLUTE';
        else if ($_SESSION['Quyen']=="Bí thư khoa"){
            $mk=$_SESSION['MaKhoa'];
            $sql="SELECT TenKhoa from khoa where MaKhoa='$mk'";
            $result = mysqli_query($conn, $sql);$row=mysqli_fetch_assoc($result);
            echo mb_strtoupper($_SESSION['Quyen'], 'UTF-8').' '.mb_strtoupper($row['TenKhoa'], 'UTF-8');
        }
        else if($_SESSION['Quyen']=="Bí thư lớp"){
            $ml=$_SESSION['MaLop'];
            $sql="SELECT TenLop from lop where MaLop='$ml'";
            $result = mysqli_query($conn, $sql);$row=mysqli_fetch_assoc($result);
            echo mb_strtoupper($_SESSION['Quyen'], 'UTF-8').' '.mb_strtoupper($row['TenLop'], 'UTF-8');;
        }
        else{
            $ml=$_SESSION['MaLop'];
            $sql="SELECT TenLop from lop where MaLop='$ml'";
            $result = mysqli_query($conn, $sql);$row=mysqli_fetch_assoc($result);
            echo mb_strtoupper($_SESSION['Quyen'], 'UTF-8').' '.mb_strtoupper($row['TenLop'], 'UTF-8');;;
        }
?></font></p>
<p><font size="2px" color="#28ee2b">Tên đăng nhập: <?php echo $_SESSION['TenDangNhap'];?></font></p>
<p><font size="2px" color="#28ee2b">Chức vụ: <?php echo $_SESSION['Quyen'];?></font></p>
<a class="logout" href="DangXuat.php">Đăng xuất</a>
</div>