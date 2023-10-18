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
    <title>Trang tạo khoa</title>
</head>
<body class="wrapper">

    <?php
        include "Header.php";
    ?>
    
    <?php
        include "Menu.php";
    ?>
    
    <div class="createLop">
        <form action="KiemTraTaoLop.php" method="post">
            <h2>TẠO LỚP MỚI</h2>

            <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <label>Chọn mã khoa của lớp:</label>
            <select name="MaKhoaTenKhoa" id="MaKhoaTenKhoa">
            <?php
            // Thực hiện truy vấn SQL
            $sql = "SELECT MaKhoa, TenKhoa FROM khoa";
            $result = $conn->query($sql);

            // Đổ dữ liệu vào trường select
            if ($result->num_rows > 0) {
                echo '<option selected value="">-- Chưa chọn khoa --</option>'; // Tùy chọn đầu tiên mặc định
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["MaKhoa"].$row["TenKhoa"] . '">' . $row["MaKhoa"].' - '.$row["TenKhoa"] . '</option>';
                }
            } else {
                echo '<option value="">Không có dữ liệu</option>';
            }
            // Đóng kết nối
            $conn->close();
            ?>
            </select><br>

            <label>Nhập năm vào học:</label>
            <input type="text" name="NamVaoHoc" id="NamVaoHoc" placeholder="Ví dụ: 2021"><br>

            <label>Nhập thứ tự lớp mới:</label>
            <input type="number" min=1 name="ThuTuLop" id="ThuTuLop" placeholder="Ví dụ: 1, 2, 3"><br>

            <label>Lớp mới sẽ có mã:</label>
            <input type="text" name="MaLop" id="MaLop" placeholder="Đang tạo mã lớp..." readonly><br>
            
            <label>Lớp mới sẽ có tên:</label>
            <input type="text" name="TenLop" id="TenLop" placeholder="Đang tạo tên lớp..." readonly><br>

            <button type="submit">Tạo lớp mới</button>

        </form>
    </div>
<script>
        // Lấy id các đối tượng (khai báo bao nhiêu thì lấy hết)
        var MaKhoaTenKhoa = document.getElementById("MaKhoaTenKhoa");
        var NamVaoHoc=document.getElementById("NamVaoHoc");
        var ThuTuLop=document.getElementById("ThuTuLop");
        var MaLop=document.getElementById("MaLop");
        var TenLop=document.getElementById("TenLop");

        // MaKhoa,NamVaoHoc,ThuTuLop là input - MaLop,TenLop là output
        MaKhoaTenKhoa.addEventListener("change", combi);
        NamVaoHoc.addEventListener("input",combi); 
        ThuTuLop.addEventListener("input",combi); 

        function combi() {
            // Lấy 3 giá trị input
            var selectedValue = MaKhoaTenKhoa.value;
            var nam=NamVaoHoc.value;
            var thutu=ThuTuLop.value;
            // Xuất chuỗi output
            MaLop.value='1'+selectedValue.substring(0, 3)+nam.slice(-2)+'A'+thutu;
            TenLop.value='Lớp '+selectedValue.slice(3)+' '+nam+" A"+thutu;
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