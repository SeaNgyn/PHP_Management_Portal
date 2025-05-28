<?php 
include '../../configuration/database.php'; 

try {
    
    $sql = "SELECT * from giang_vien gv 
        join giangvien_malophp gvmlhp on gv.id = gvmlhp.giang_vien_id 
        join ma_lop_hp mlhp on mlhp.id = gvmlhp.id_ma_lop_hp 
        join mon_hoc mh on mlhp.id_mon_hoc = mh.id where gvmlhp.giang_vien_id = 68
      
        -- where gvmlhp.giang_vien_id = 19
--     SELECT *
-- FROM ma_lop_hp ml
-- JOIN mon_hoc mh ON ml.id_mon_hoc = mh.id
-- JOIN giangvien_monhoc gvmh ON gvmh.id_mon_hoc = mh.id
-- JOIN giang_vien gv ON gvmh.giang_vien_id = gv.id;
";
    if ($connection === null) {
        throw new Exception("Database connection is not established.");
    }
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $monhocs = $statement->fetchAll();

    // $sql = "SELECT * FROM giang_vien WHERE id = 29 ";
//     $count = "SELECT 
//     mlhp.ten_ma_lop_hp, 
//     COUNT(gvmlhp.giang_vien_id) AS so_giang_vien
// FROM 
//     ma_lop_hp mlhp
// JOIN 
//     giangvien_malophp gvmlhp ON mlhp.id = gvmlhp.id_ma_lop_hp
// GROUP BY 
//     mlhp.ten_ma_lop_hp;";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $gv = $statement->fetch(PDO::FETCH_ASSOC);
    $tenGiangVien = $gv['Name'] ?? 'Không tìm thấy';
    //dem
    // $statement = $connection->prepare($count);
    // $statement->execute();
    // $statement->setFetchMode(PDO::FETCH_ASSOC);
    // $results = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();}
    

?>
<?php include '../layouts/header.php'; ?>

<div id="divMain" class="row row2">
    <div class="col-sm-2 sidebar" style="background-color:#2e43d1;padding-right: 0">
        <?php include '../layouts/sidebar.php'; ?>
    </div>
    <div class="col-sm-10 content" style="background-color:rgb(252, 252, 252);">
        <div id="modTitle" class="module-title" style="height:25px;margin-left:-15px;">Chi tiết</div>
        <div class="panel panel-primary " style="margin-top: 20px; height: auto; ">
            <div class="panel-heading"
                style="height: auto; font-size: 20px; font-family: Helvetica; color: white;background-color:blue">Danh
                sách môn chi tiết học phần </div>
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
                            <th>Loại lớp</th>
                            <th>Khoa</th>
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
                        $maHp = $monhoc['ma_mon'] ?? '';
                        $tenHp = $monhoc['ten_mon'] ?? '';
                        $soTc = $monhoc['so_tin_chi'] ?? '';
                        $maLopHp = $monhoc['ten_ma_lop_hp'] ?? '';
                        $phanBoTc = $monhoc['phan_bo_tin_chi'] ?? '';
                        $loaiLop = $monhoc['loai_lop'] ?? '';
                        $nganh = $monhoc['nganh'] ?? '';
                        $khoa = $monhoc['khoa'] ?? '';
                        $chuongTrinhDt = $monhoc['chuong_trinh_dao_tao'] ?? '';
                        $soLuongSv = $monhoc['so_luong_sv'] ?? '';
                        $thu = $monhoc['thu'] ?? '';
                        $tiet = $monhoc['tiet'] ?? '';
                        $ngonNguGiangDay = $monhoc['ngon_ngu_giang_day'] ?? '';
                        // $giangVien = $monhoc['ten_gv'] ?? '';
                        $giangDuong = $monhoc['giang_duong'] ?? '';


                        echo '<tr>';
                        echo "<td>$STT</td>";
                        echo "<td>$maHp</td>";
                        echo "<td>$tenHp</td>";
                        echo "<td >$soTc</td>";
                        echo "<td>$maLopHp</td>";
                        echo "<td>$phanBoTc</td>";

                        echo "<td>$loaiLop</td>";
                        // echo "<td>$nganh</td>";
                        echo "<td>$khoa</td>";
                        //echo "<td>$chuongTrinhDt</td>";
                        echo "<td>$thu</td>";
                        echo "<td>$tiet</td>";
                        echo "<td>$soLuongSv</td>";
                        echo "<td>$giangDuong</td>";
                        echo "<td>$ngonNguGiangDay</td>";
                        // echo "<td>" . calculateTimeToStudy($phanBoTc, $soLuongSv, $ngonNguGiangDay, $thu, $tiet, $loaiLop,$countGvMap[$maLopHp]) . "</td>";
                        // echo "<td>$giangVien</td>";
                        echo '</tr>';
                    }
                    //echo '<a href="index.php">Click here to back Home to upload file</a>';
                    ?>
                        <!-- Các dòng dữ liệu khác có thể thêm vào đây -->
                    </tbody>
                </table>
            </div>

        </div>


    </div>
</div>