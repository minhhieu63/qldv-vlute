<?php 
session_start(); 
include "conn.php";
if(isset($_SESSION)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="style.css">
    <title>Trang thông tin đoàn viên</title>
</head>
<body class="wrapper">

    <?php
        include "Header.php";
    ?>
    
    <?php
        include "Menu.php";
    ?>
    
    
    
    <script>
        
    </script>

</body>
</html>


<?php 
}
else{
    header("Location: index.php");
    exit();
}