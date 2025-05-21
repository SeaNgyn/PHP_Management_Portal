<?php
include '../../configuration/database.php';
try {
    $sql = "SELECT * from monhoc;";
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
<!-- Danh sách môn học -->
<div class="panel panel-primary " style="margin-top: 20px; height: auto; ">
    <div class="panel-heading" style="height: auto; font-size: 20px; font-family: Helvetica; color: white;background-color:blue">Danh sách môn học được phân
        công</div>
    <div class="panel-body" style="height: auto;">
        <table class="table table-striped" id="courseTable">
            <thead>
                <tr style="background-color: #f5f5f5; color: 000;">
                    <th>STT</th>
                    <th>Mã học phần</th>
                    <th>Tên học phần</th>
                    <th>Số tín chỉ</th>
                    <th>Mã lớp học phần</th>
                    <th>Phân bố tín chỉ</th>
                    <th>Khoá</th>
                    <th>Thứ</th>
                    <th>Tiết</th>
                    <th>Số lượng sinh viên</th>
                    <th>Giảng đường</th>
                    <th>Ngôn ngữ giảng dạy</th>
                    <th>Thời gian dạy</th>
                    <!-- <th>Giảng viên</th> -->
                </tr>
            </thead>
            <tbody style="color: #4f535a;">
                <?php
                foreach ($monhocs as $monhoc) {
                    $STT = $monhoc['STT'] ?? '';
                    $maHp = $monhoc['ma_hp'] ?? '';
                    $tenHp = $monhoc['ten_hp'] ?? '';
                    $soTc = $monhoc['so_tin_chi'] ?? '';
                    $maLopHp = $monhoc['ma_lop_hp'] ?? '';
                    $phanBoTc = $monhoc['phan_bo_tin_chi'] ?? '';
                    $loaiLop = $monhoc['loai_lop'] ?? '';
                    $nganh = $monhoc['nganh'] ?? '';
                    $khoa = $monhoc['khoa'] ?? '';
                    $chuongTrinhDt = $monhoc['chuong_trinh_dao_tao'] ?? '';
                    $soLuongSv = $monhoc['so_luong_sv'] ?? '';
                    $thu = $monhoc['thu'] ?? '';
                    $tiet = $monhoc['tiet'] ?? '';
                    $ngonNguGiangDay = $monhoc['ngon_ngu_giang_day'] ?? '';
                    $giangDuong = $monhoc['giang_duong'] ?? '';

                    echo '<tr>';
                    echo "<td>$STT</td>";
                    echo "<td>$maHp</td>";
                    echo "<td>$tenHp</td>";
                    echo "<td>$soTc</td>";
                    echo "<td>$maLopHp</td>";
                    echo "<td>$phanBoTc</td>";
                    // echo "<td>$loaiLop</td>";
                    // echo "<td>$nganh</td>";
                    echo "<td>$khoa</td>";
                    //echo "<td>$chuongTrinhDt</td>";
                    echo "<td>$thu</td>";
                    echo "<td>$tiet</td>";
                    echo "<td>$soLuongSv</td>";
                    echo "<td>$ngonNguGiangDay</td>";
                    echo "<td>$giangDuong</td>";
                    echo "<td>" . calculateTimeToStudy($phanBoTc) . "</td>";

                    echo '</tr>';
                }
                //echo '<a href="index.php">Click here to back Home to upload file</a>';
                ?>
                <!-- Các dòng dữ liệu khác có thể thêm vào đây -->
            </tbody>
        </table>
    </div>

</div>

<?php
function calculateTimeToStudy($phanBoTc)
{
    $tinChiSplit = explode("/", $phanBoTc);
    //explode() — là cách phổ biến và hiệu quả nhất để tách chuỗi theo ký tự phân cách.
    $count = count($tinChiSplit);
    if ($count >= 2) {
        $calTC = $tinChiSplit[0] + $tinChiSplit[$count - 1];
        return $calTC; // Có trên 1 phần tử
    } elseif ($count === 1) {
        return $tinChiSplit[0]; // chỉ có 1 phần tử
    } else {
        return 0; // không có dữ liệu hợp lệ
    }
}
?>
<!-- Biểu đồ -->
<!-- <div class="row">
    <div class="col-sm-12">
        <canvas id="teachingChart" style="width: 100%; height: 400px; "></canvas>
    </div>
</div> -->