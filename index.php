<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Đăng nhập</title>
</head>
<body class="login">
    
    <section>
        <div class="logo">
            <table class="hi">
                <tr>
                    <td><img width="100px" src="logo-doan-thanh-nien_093419509.png"></td>
                    <td><img width="100px" src="dai-hoc-su-pham-ky-thuat-vinh-long.png"></td>
                </tr>
            </table>
        </div>
    <form action="KiemTraDangNhap.php" method="post">
          
        <h2><font color="#359dff">ĐĂNG NHẬP HỆ THỐNG</font></h2>

        <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
        
         <div class="input-group">
            <input type="text" name="TenDangNhap" required>
            <label for="">Tên đăng nhập</label>
        </div>

        <div class="input-group">
            <input type="password" name="MatKhau" required>
            <label for="">Mật khẩu</label>
        </div>


        
        <button type="submit">Đăng nhập</button>
    </form>

        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
    </section>
</body>
</html>