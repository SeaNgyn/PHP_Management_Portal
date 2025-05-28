<?php include '../layouts/header.php'; ?>
<?php
include '../../configuration/database.php';
try {
    $sql = "SELECT * from mon_hoc;";
    if ($connection === null) {
        throw new Exception("Database connection is not established.");
    }
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $monhocs = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<div id="divMain" class="row row2">
    <div class="col-sm-2 sidebar" style="background-color:#2e43d1;padding-right: 0">
        <?php include '../layouts/sidebar.php'; ?>
    </div>
    <div class="col-sm-10 content" style="background-color:rgb(252, 252, 252);">
        <div id="modTitle" class="module-title" style="height:25px;margin-left:-15px;">Tìm kiếm</div>

        <div class="search-container" style="height: 5% ; margin-bottom: 50px;">
            <input type="text" id="searchCode" placeholder="Tìm kiếm...">
            <button onclick="searchCourse()" class="search-button" style="background-color: #2e43d1;">Tìm kiếm</button>
        </div>
        <!-- Gắn Bootstrap 3 nếu chưa có -->


        <div class="container" style="background-color: #fcf9f9; padding: 20px;">
            <div class="panel panel-default">
                <div class="panel-heading text-center" style=" background-color: blue;">
                    <h3 class="panel-title" style="font-size: 20px; font-family: Helvetica; color: white; ">
                        Thông tin môn học
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="courseTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr style="background-color: #f5f5f5; color: 000;">
                                    <!-- <th>STT</th> -->
                                    <th>Mã học phần</th>
                                    <th>Tên học phần</th>
                                    <th>Số tín chỉ</th>
                                    <!-- <th>Phân bố tín chỉ</th>
                                    <th>Khoá</th>
                                    <th>Thứ</th>
                                    <th>Tiết</th>
                                    <th>Số lượng sinh viên</th>
                                    <th>Giảng đường</th>
                                    <th>Ngôn ngữ giảng dạy</th>
                                    <th>Giảng viên</th> -->
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="color: #4f535a;">
                                <?php
                                foreach ($monhocs as $monhoc) {
                                    $maHp = $monhoc['ma_mon'] ?? '';
                                    $tenHp = $monhoc['ten_mon'] ?? '';
                                    $soTc = $monhoc['so_tin_chi'] ?? '';

                                    echo '<tr>';
                                    // echo "<td>$STT</td>";
                                    echo "<td>$maHp</td>";
                                    echo "<td>$tenHp</td>";
                                    echo "<td>$soTc</td>";
                                    // echo "<td>$maLopHp</td>";
                                    // echo "<td>$phanBoTc</td>";
                                    // echo "<td>$loaiLop</td>";
                                    // echo "<td>$nganh</td>";
                                    // echo "<td>$khoa</td>";
                                    // echo "<td>$chuongTrinhDt</td>";
                                    // echo "<td>$soLuongSv</td>";
                                    // echo "<td>$thu</td>";
                                    // echo "<td>$tiet</td>";
                                    // echo "<td>$ngonNguGiangDay</td>";
                                    // echo "<td>$giangDuong</td>";
                                    echo '<td><a href="">Xem chi tiết</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                                <!-- Các dòng dữ liệu khác có thể thêm vào đây -->
                            </tbody>
                        </table>
                    </div>
                    <p id="result"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../js/search.js"></script>