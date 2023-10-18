<?php 
session_start(); 
include "conn.php";
if(isset($_SESSION['TenDangNhap'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="style.css">
    <title>Trang tạo tài khoản bí thư khoa</title>
</head>
<body class="wrapper">
    <?php
        include "Header.php";
    ?>
    <?php
        include "Menu.php";
    ?>
    <div class="createBTK">
        <form action="KiemTraTaoBiThuKhoa.php" method="post">
            <h2>TẠO TÀI KHOẢN BÍ THƯ KHOA</h2>
            <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <label>Chọn mã khoa của bí thư khoa:</label>
            <select name="MaKhoa" id="MaKhoa">
            <?php
            // Thực hiện truy vấn SQL
            $sql = "SELECT MaKhoa, TenKhoa FROM khoa";
            $result = $conn->query($sql);

            // Đổ dữ liệu vào trường select
            if ($result->num_rows > 0) {
                echo '<option selected value="">-- Chưa chọn khoa --</option>'; // Tùy chọn đầu tiên mặc định
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["MaKhoa"] . '">' . $row["MaKhoa"].' - '.$row["TenKhoa"] . '</option>';
                }
            } else {
                echo '<option value="">Không có dữ liệu</option>';
            }
            // Đóng kết nối
            $conn->close();
            ?>
            </select><br>


            <label>Nhập họ và tên bí thư khoa:</label>
            <input type="text" name="HoVaTen" id="HoVaTen" placeholder="Ví dụ: Mai Thiên Thư"><br>

            <label>Nhập email bí thư khoa:</label>
            <input type="email" name="Email" id="Email" placeholder="Ví dụ: maitt@gmail.com"><br>

            <label>Mã bí thư khoa:</label>
            <input type="text" name="MaTaiKhoan" id="MaTaiKhoan" placeholder="Ví dụ: BTK1, BTK2" readonly><br>

            <label>Tên đăng nhập của bí thư khoa:</label>
            <input type="text" name="TenDangNhap" id="TenDangNhap" placeholder="Đang soạn..." readonly><br>
            
            <label>Mật khẩu (có thể nhập mk khác):</label>
            <input type="text" name="MatKhau" id="MatKhau" ><br>

            <button type="submit">Tạo tài khoản</button>

        </form>

    </div>
    <script>
        var MaKhoa = document.getElementById("MaKhoa");
        var HoVaTen=document.getElementById("HoVaTen");
        var MaTaiKhoan=document.getElementById("MaTaiKhoan");
        var TenDangNhap=document.getElementById("TenDangNhap");
        var MatKhau=document.getElementById("MatKhau");
        
        MaKhoa.addEventListener("change", combi);
        HoVaTen.addEventListener("input", combi);
        
        function combi(){
            var selectedMaKhoa = MaKhoa.value;
            var hoten=HoVaTen.value;
            MaTaiKhoan.value="BTK_"+selectedMaKhoa;
            TenDangNhap.value=xuLyChuoi(hoten)+"BTK" + selectedMaKhoa;
        }
        function xuLyChuoi(chuoi) {
            // Bước 1: Loại bỏ khoảng trắng
            var chuoiKhongKhoangTrang = chuoi.replace(/\s+/g, "");

            // Bước 2: Chuyển thành chuỗi thường (viết thường)
            var chuoiChuThuong = chuoiKhongKhoangTrang.toLowerCase();

            // Bước 3: Chuyển thành chuỗi không dấu (loại bỏ dấu tiếng Việt)
            var chuoiKhongDau = chuoiChuThuong
                .replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a")
                .replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e")
                .replace(/ì|í|ị|ỉ|ĩ/g, "i")
                .replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o")
                .replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u")
                .replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y")
                .replace(/đ/g, "d")
                .replace(/[^a-z0-9]/g, ""); // Loại bỏ các ký tự khác

        return chuoiKhongDau;
        }
        MatKhau.value="btk123";

    </script>

</body>
</html>


<?php 
}
else{
    header("Location: index.php");
    exit();
}