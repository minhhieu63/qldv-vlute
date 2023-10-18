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
    <title>Trang tạo tài khoản đoàn viên</title>
</head>
<body class="wrapper">

    <?php
        include "Header.php";
    ?>
    
    <?php
        include "Menu.php";
    ?>
    
    <div class="createBTK">
        <form action="KiemTraTaoDoanVien.php" method="post">
            <h2>TẠO TÀI KHOẢN ĐOÀN VIÊN</h2>

            <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <label>Chọn mã lớp của đoàn viên:</label>
            <select name="MaLop" id="MaLop">
            <?php
            // Thực hiện truy vấn SQL
            $sql = "SELECT * FROM lop";
            $result = $conn->query($sql);

            // Đổ dữ liệu vào trường select
            if ($result->num_rows > 0) {
                echo '<option selected value="">-- Chưa chọn lớp --</option>'; // Tùy chọn đầu tiên mặc định
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["MaLop"] . '">' . $row["MaLop"].' ('.$row["MaSoLop"].'??)'.' - '.$row["TenLop"] . '</option>';
                }
            } else {
                echo '<option value="">Không có dữ liệu</option>';
            }
            // Đóng kết nối
            $conn->close();
            ?>
            </select><br>

            <label>Nhập mã đoàn viên:</label>
            <input type="text" name="MaTaiKhoan" id="MaTaiKhoan" placeholder="Ví dụ: DV01, DV02, ... , DV1000 " ><br>

            <label>Nhập MSSV của đoàn viên:</label>
            <input type="text" name="MSSV" id="MSSV" placeholder="Ví dụ: 21004001"><br>

            <label>Tên đăng nhập của đoàn viên mới:</label>
            <input type="text" name="TenDangNhap" id="TenDangNhap" placeholder="Đang soạn..." readonly><br>

            <label>Email của đoàn viên:</label>
            <input type="email" name="Email" id="Email" placeholder="Đang soạn..." readonly><br>
            
            <label>Mật khẩu (có thể nhập mk khác):</label>
            <input type="text" name="MatKhau" id="MatKhau" ><br>

            <button type="submit">Tạo tài khoản</button>

        </form>

    </div>
    <script>
        var mssv=document.getElementById("MSSV");
        var tdn=document.getElementById("TenDangNhap");
        var mk=document.getElementById("MatKhau");mk.value="dv123";
        var e=document.getElementById("Email");
        mssv.addEventListener("input",combi);  
        function combi() {
            var ms=mssv.value;
            // Xuất chuỗi output
            ;tdn.value=ms; e.value=ms+'@st.vlute.edu.vn';
        }
    </script>

</body>
</html>


<?php 
}
else{
    header("Location: index.php");
    exit();
}