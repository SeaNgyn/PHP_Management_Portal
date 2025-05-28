<?php
include '../../configuration/database.php';
if (isset($_GET['trang'])){
    $page = $_GET['trang'];
}else{
    $page = '';
}

if($page ==''|| $page ==1){
    $begin = 0;
}else{
    $begin = ($page*10)-10;
}
try {
    
    $sql = "SELECT * from giang_vien gv 
        join giangvien_malophp gvmlhp on gv.id = gvmlhp.giang_vien_id 
        join ma_lop_hp mlhp on mlhp.id = gvmlhp.id_ma_lop_hp 
        join mon_hoc mh on mlhp.id_mon_hoc = mh.id where gvmlhp.giang_vien_id = 68
        LIMIT $begin,10;
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

    $sql = "SELECT * FROM giang_vien WHERE id = 29 ";
    $count = "SELECT 
    mlhp.ten_ma_lop_hp, 
    COUNT(gvmlhp.giang_vien_id) AS so_giang_vien
FROM 
    ma_lop_hp mlhp
JOIN 
    giangvien_malophp gvmlhp ON mlhp.id = gvmlhp.id_ma_lop_hp
GROUP BY 
    mlhp.ten_ma_lop_hp;";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $gv = $statement->fetch(PDO::FETCH_ASSOC);
    $tenGiangVien = $gv['Name'] ?? 'Không tìm thấy';
    //dem
    $statement = $connection->prepare($count);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $results = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    
}
$countGvMap =[];
foreach($results as $row){
    $maLopHp = $row['ten_ma_lop_hp'];
    $soGv = $row['so_giang_vien'];
    $countGvMap[$maLopHp] = $soGv;
    // print_r($countGvMap[''])
    }
    // print_r($countGvMap['PHY3507 2']);
?>
<!-- Danh sách môn học -->
<div class="panel panel-primary " style="margin-top: 20px; height: auto; ">
    <div class="panel-heading"
        style="height: auto; font-size: 20px; font-family: Helvetica; color: white;background-color:blue">Danh sách môn
        học được phân
        công <?php echo $tenGiangVien ?>: </div>
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
                        echo "<td>" . calculateTimeToStudy($phanBoTc, $soLuongSv, $ngonNguGiangDay, $thu, $tiet, $loaiLop,$countGvMap[$maLopHp]) . "</td>";
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

<?php

   
    function Ks($soLuongSv, $loaiLop,$maLopHp)
    {
    
     //$soGv = $countGvMap[$maLopHp] ?? 1; // mặc định là 1 nếu không có trong map
     $soGv=$maLopHp;
     
        switch ($loaiLop) {
            case str_contains($loaiLop,'TH'):
                $hs1 = ($soLuongSv < 15) ? 0.8 : (($soLuongSv < 20) ? 1.0 : 1.2);
                $hs = $hs1/$soGv; 
                return $hs;
                break;
            // case "'str_contains($loaiLop,'LT')'":
                case 'LT':
                // Xử lý theo lớp LT
                $hs = ($soLuongSv <= 40) ? 1.0 : (($soLuongSv <= 60) ? 1.1 : (($soLuongSv <= 80) ? 1.2 : (($soLuongSv <= 100) ? 1.3 : (($soLuongSv <= 120) ? 1.4 : 1.5))));
                return $hs;
                break;
            case str_contains($loaiLop,'BT'):
                $hs = ($soLuongSv <= 40) ? 1.0 : (($soLuongSv <= 60) ? 1.1 : (($soLuongSv <= 80) ? 1.2 : (($soLuongSv <= 100) ? 1.3 : (($soLuongSv <= 120) ? 1.4 : 1.5))));
                return $hs;
                break;
            default:
                // Xử lý mặc định
        }
    }
    function Kn($ngonNguGiangDay)
    {
        switch ($ngonNguGiangDay) {
            case "Tiếng Việt":
                return 1.0;
                break;
            default:
                return 1.5;
        }
    }
    function Kt($thu, $tiet)
    {
        $tietSplit = explode("-", $tiet);
        if ($thu >= 2 && $thu <= 6 && array_filter($tietSplit, fn($x) => $x < 10)) {
            return 1;
        } else {
            return 1.5;
        }
    }
    

    function calculateTimeToStudy($phanBoTc, $soLuongSv, $ngonNguGiangDay, $thu, $tiet, $loaiLop,$maLopHp)
    {
        // Gọi hàm tính hệ số
        $ks = Ks($soLuongSv, $loaiLop,$maLopHp);
        $kn = Kn($ngonNguGiangDay);
        $kt = Kt($thu, $tiet);

        // $tinChiSplit = explode("/", $phanBoTc);
        //explode() — là cách phổ biến và hiệu quả nhất để tách chuỗi theo ký tự phân cách.
        // $count = count($tinChiSplit);

        // Sử dụng biểu thức chính quy để tìm tất cả các chuỗi số
        preg_match_all('/\d+/', $phanBoTc, $matches);
        // $matches[0] chứa mảng các số tìm được
        //doi mang 2 chieu thanh 1 chieu
        $tinChiSplit = $matches[0];
        $count = count($tinChiSplit);

       if($ngonNguGiangDay=="Tiếng Việt"){
         $C = 1.5;
       }else{
        $C = 2;
       }
    $G1 = min($ks * $kn * $kt,$C);
    $G2 = min(($ks * $kn * $kt)/2,$C);
        if ($soLuongSv <= 15) {
            switch ($count) {
                case 4:
                    $calTC = $tinChiSplit[1] + $tinChiSplit[$count - 2];
                    return $calTC *  $G2;
                    break;
                case 2:
                    $calTC = $tinChiSplit[0] + $tinChiSplit[$count - 1];
                    return $calTC *  $G2;
                    break;
                case 3:
                    $calTC = $tinChiSplit[0] + $tinChiSplit[$count - 2];
                    return $calTC *  $G2;
                    break;
                default:
                    return "no data";
            }
        } else {
            switch ($count) {
                case 4:
                    $calTC = $tinChiSplit[1] + $tinChiSplit[$count - 2];
                    return $calTC *  $G1;
                    break;
                case 2:
                    $calTC = $tinChiSplit[0] + $tinChiSplit[$count - 1];
                    return $calTC *  $G1;
                    break;
                case 3:
                    $calTC = $tinChiSplit[0] + $tinChiSplit[$count - 2];
                    return $calTC*  $G1;
                    break;
                default:
                    return "no data";
            }
        }


        // if ($count >= 2) {
        //     $calTC = $tinChiSplit[0] + $tinChiSplit[$count - 1];
        //     return $calTC; // Có trên 1 phần tử
        // } elseif ($count === 1) {
        //     return $tinChiSplit[0]; // chỉ có 1 phần tử
        // } else {
        //     return 0; // không có dữ liệu hợp lệ
        // }


    }
    ?>
<!-- Biểu đồ -->
<!-- <div class="row">
    <div class="col-sm-12">
        <canvas id="teachingChart" style="width: 100%; height: 400px; "></canvas>
    </div>
</div> -->