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
    
    <div class="taoKhoa">
        <form action="KiemTraTaoKhoa.php" method="post">
            <h2>TẠO KHOA MỚI</h2>

            <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <label>Nhập mã khoa:</label>
            <input type="text" name="MaKhoa" pattern="[A-Z]{3}" required title="Mã khoa phải bao gồm 3 kí tự in hoa!" placeholder="Ví dụ: CTT, KTE"><br>
                
            <label>Nhập mã số khoa:</label>
            <input type="text" name="MaSoKhoa" pattern="[0-9]{3}" required title="Mã số khoa phải bao gồm 3 kí tự số!" placeholder="Ví dụ: 004, 017"><br>

            <label>Nhập tên khoa:</label>
            <input type="text" name="TenKhoa" placeholder="Ví dụ: Công nghệ thông tin, Kinh tế"><br>

            <button type="submit">Tạo khoa mới</button>

        </form>
    </div>
</body>
</html>
<?php 
}
else{
    header("Location: index.php");
    exit();
}