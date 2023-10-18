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
    <title>Xem danh sách lớp</title>
</head>
<body class="wrapper">
    <?php
        include "Header.php";
    ?>
    <?php
        include "Menu.php";
    ?>
    
    <div class="wptable">
        <div class="displaytb">
		<h2 >DANH SÁCH LỚP</h2>
		<label>Lọc theo mã khoa:</label>

            <select class="slKhoa" name="MaKhoa" id="selectKhoa">
            <?php
            // Thực hiện truy vấn SQL
            $sql = "SELECT MaKhoa, TenKhoa FROM khoa";
            $result = $conn->query($sql);

            // Đổ dữ liệu vào trường select
            if ($result->num_rows > 0) {
                echo '<option value="">-- Chưa chọn khoa --</option>'; // Tùy chọn đầu tiên mặc định
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["MaKhoa"] . '">' . $row["MaKhoa"].' - '.$row["TenKhoa"] . '</option>';
                }
            } else {
                echo '<option value="">Không có dữ liệu</option>';
            }
            ?>   
            </select>

			<table id="tableLop">
			    <thead>
			        <tr>
			            <th width='50px'>STT</th>
			            <th width='100px'>Mã lớp</th>
			            <th width='300px'>Tên lớp</th>
			            <th width='150px'>Năm vào học</th>
                        <th width='150px'>Thứ tự lớp</th>
                        <th width='150px'>Hành động</th>
			        </tr>
			    </thead>
			    <tbody id="tableBody">
                    <!-- Đổ dữ liệu ở đây -->
                    
			    </tbody>
			</table>
        </div>
    </div>
</body>
</html>


<script>
    $(document).ready(function () {
        $("#selectKhoa").change(function () {
        var selectedValue = $(this).val();
        $.ajax({
            url: "LayLop.php",
            method: "POST",
            data: { selectedValue: selectedValue },
            dataType: "json",
            success: function (data) {
                var tableBody = $("#tableBody");
                // Xóa dữ liệu cũ (nếu có)
                tableBody.empty();

                // Thêm dữ liệu mới vào bảng
                for (var i = 0; i < data.length; i++) {
                    var row = $("<tr>");
                    row.append("<td width='50px'>" + (i + 1) + "</td>");
                    row.append("<td width='100px'>" + data[i].MaLop + "</td>");
                    row.append("<td width='300px'>" + data[i].TenLop + "</td>");
					row.append("<td width='150px'>" + data[i].NamVaoHoc + "</td>");
					row.append("<td width='150px'>" + data[i].ThuTuLop + "</td>");

                    // Tạo thẻ <a> cho hành động Xóa và Sửa
                    var actions = $("<td width='150px'>");
                    var deleteLink = $("<a href='#' class='delete'>Xóa</a>");
                    var editLink = $("<a href='#' class='update'>Sửa</a>");

                    // Đặt data-id để lưu giữa Mã Lớp
                    deleteLink.attr("data-id", data[i].MaLop);
                    editLink.attr("data-id", data[i].MaLop);

                    actions.append(deleteLink);
                    actions.append(editLink);

                    row.append(actions);
                    tableBody.append(row);
                }

                // Bắt sự kiện click cho các liên kết Xóa và Sửa
                $(".delete").click(function () {
                    var maLop = $(this).attr("data-id");
                    // Gọi hàm xóa ở đây
                    deleteLop(maLop);
                });

                $(".update").click(function () {
                    var maLop = $(this).attr("data-id");
                    // Gọi hàm chỉnh sửa ở đây
                    editLop(maLop);
                });
            },
            error: function (error) {
                console.error('Lỗi:', error);
            }
        });
    });
});

    function deleteLop(maLop) {
        if (confirm("Bạn có chắc chắn muốn xóa lớp này không?")) {
            // Gọi AJAX để xóa lớp với mã lớp đã cho
            $.ajax({
                url: "XoaLop.php",
                method: "POST",
                data: { maLop: maLop },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        alert("Xóa thành công");
                        // Cập nhật lại bảng sau khi xóa
                        $("#selectKhoa").trigger("change");
                    } else {
                        alert("Xóa không thành công");
                    }
                },
                error: function (error) {
                    console.error('Lỗi:', error);
                }
            });
        }
    }

    function editLop(maLop) {
        // Điều hướng đến trang chỉnh sửa lớp với mã lớp đã cho
        window.location.href = "edit.php?maLop=" + maLop;
    }
			
</script>

<?php 
}
else{
    header("Location: index.php");
    exit();
}