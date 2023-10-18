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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="style.css">
    <title>Danh sách khoa</title>
</head>
<body class="wrapper">
    <?php
        include "Header.php";
    ?>
    <?php
        include "Menu.php";
    ?>
    
    <div class="wptable">
        <form class="displaytb">
			<h2 >DANH SÁCH KHOA</h2>
			<table id="tableKhoa">
                <thead>
                    <tr>
                        <th width="50px">STT</th>
                        <th width="100px">Mã khoa</th>
                        <th width="150px">Mã số khoa</th>
                        <th width="250px">Tên khoa</th>
                        <th width="150px">Hành động</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Đổ dữ liệu tại đây -->
                </tbody>
            </table>
            </form>
	</div>
</body>
</html>
<script>
    $(document).ready(function () {
        // Gọi hàm load dữ liệu Khoa khi trang được tải
        loadKhoa();
        function loadKhoa() {
            $.ajax({url: "LayKhoa.php", method: "GET", dataType: "json", success: function (data) {
                var tableBody = $("#tableBody");
                // Xóa dữ liệu cũ (nếu có)
                tableBody.empty();

                // Thêm dữ liệu mới vào bảng
                for (var i = 0; i < data.length; i++) {
                    var row = $("<tr>");
                    row.append("<td>" + (i + 1) + "</td>");
                    row.append("<td>" + data[i].MaKhoa + "</td>");
                    row.append("<td>" + data[i].MaSoKhoa + "</td>");
                    row.append("<td>" + data[i].TenKhoa + "</td>");

                    // Tạo thẻ <a> cho hành động Xóa
                    var actions = $("<td>");
                    var deleteLink = $("<a href='#' class='delete'>Xóa</a>");
                    var updateLink = $("<a href='#' class='update'>Sửa</a>");
                    // Đặt data-id để lưu mã khoa
                    deleteLink.attr("data-id", data[i].MaKhoa);
                    updateLink.attr("data-id", data[i].MaKhoa);
                    actions.append(deleteLink);
                    actions.append(updateLink);
                    row.append(actions);
                    tableBody.append(row);
                }

                // Bắt sự kiện click cho các liên kết Xóa
                $(".delete").click(function () {
                    var maKhoa = $(this).attr("data-id");
                    // Gọi hàm xóa Khoa ở đây
                    deleteKhoa(maKhoa);
                });
                }, error: function (error) {
                    console.error('Lỗi:', error);
                }
            });
        }   
        function deleteKhoa(maKhoa) {
            if (confirm("Bạn có chắc chắn muốn xóa khoa này không?")) {
                // Gọi AJAX để xóa Khoa với mã khoa đã cho
                $.ajax({url: "XoaKhoa.php", method: "POST", data: { maKhoa: maKhoa }, dataType: "json", success: function (response) {
                    if (response.success) {
                        alert("Xóa thành công");
                        // Cập nhật lại bảng sau khi xóa
                        loadKhoa();
                    } else {
                        alert("Xóa không thành công");
                    }
                }, error: function (error) {
                    console.error('Lỗi:', error);
                }
            });
        }
    }
});
</script>

<?php 
}
else{
    header("Location: index.php");
    exit();
}