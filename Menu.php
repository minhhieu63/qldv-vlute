<?php if($_SESSION['Quyen']=="Bí thư trường"){ ?>
    <div class="box-menu">
        <ul>
            <li><a href="#">QUẢN LÝ ĐỐI TƯỢNG</a>
                <div class="box-submenu">
                    <ul>
                        <li class="submenu-hover"><a href="#">KHOA</a><i class="fa fa-angle-right" aria-hidden="true"></i>
                            <div class="box-submenu-2">
                                <ul>
                                    <li><a href="TaoKhoa.php">TẠO KHOA MỚI</a></li>
                                    <li><a href="DanhSachKhoa.php">DANH SÁCH KHOA</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="submenu-hover"><a href="#">LỚP</a><i class="fa fa-angle-right" aria-hidden="true"></i>
                            <div class="box-submenu-2">
                                <ul>
                                    <li><a href="TaoLop.php">TẠO LỚP MỚI</a></li>
                                    <li><a href="DanhSachLop.php">DANH SÁCH LỚP</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="submenu-hover"><a href="#">BÍ THƯ KHOA</a><i class="fa fa-angle-right" aria-hidden="true"></i>
                            <div class="box-submenu-2">
                                <ul>
                                    <li><a href="TaoBiThuKhoa.php">TẠO TÀI KHOẢN MỚI</a></li>
                                    <li><a href="DanhSachBiThuKhoa.php">DANH SÁCH BÍ THƯ KHOA</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="submenu-hover"><a href="#">ĐOÀN VIÊN</a><i class="fa fa-angle-right" aria-hidden="true"></i>
                            <div class="box-submenu-2">
                                <ul>
                                    <li><a href="TaoDoanVien.php">TẠO TÀI KHOẢN MỚI</a></li>
                                    <li><a href="DanhSachDoanVien.php">DANH SÁCH ĐOÀN VIÊN</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
<?php } else if ($_SESSION['Quyen']=="Bí thư khoa"){ ?>
    <div class="box-menu">
        <ul>
            <li><a href="BauBiThuLop.php">BẦU BÍ THƯ LỚP</a></li>
            <li><a href="XemThongTinChiTiet.php">XEM THÔNG TIN CHI TIẾT</a></li>
        </ul>
    </div>

<?php } ?>