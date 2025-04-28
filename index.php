<?php
include './configuration/database.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

libxml_use_internal_errors(true);


if (isset($_POST['Submit'])) {
    $file = $_FILES['fileExcel']['tmp_name'];

    // Tắt warning DOMDocument
    libxml_use_internal_errors(true);

    // Đọc file Excel
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();


    // echo "Số dòng dữ liệu: " . count($data) - 1 . "<br>"; // in ra số dòng
    // echo "stt:" . $data[2]['0']. "<br>";
    // echo "ma lap hoc phan:" . $data[2]['4']. "<br>";
    for ($row = 0; $row <= count($data) - 1; $row++) {
        if (!is_numeric($data[$row]['0'])) {
            continue; // bỏ qua nếu không phải số
        } else {
            // echo $row . "STT:" . $data[$row]['0']. "<br>";
            // echo "MHP:" . $data[$row]['1']. "<br>"; 
            // echo "<br>";
            // echo "Tên HP:" . $data[$row]['2']. "<br>"; 
            // echo "STC:" . $data[$row]['3']. "<br>"; 
            $STT = $data[$row]['0'];
            $maHp = $data[$row]['1'];
            $tenHp = $data[$row]['2'];
            $soTc = $data[$row]['3'];
            $maLopHp = $data[$row]['4'];
            $phanBoTc = $data[$row]['5'];
            $loaiLop = $data[$row]['7'];
            $nganh = $data[$row]['9'];
            $khoa = $data[$row]['25'];
            $chuongTrinhDt = $data[$row]['10'];
            $soLuongSv = $data[$row]['13'];
            $thu = $data[$row]['16'];
            $tiet = $data[$row]['17'];
            $ngonNguGiangDay = $data[$row]['19'];
            $giangDuong = $data[$row]['18'];

            if ($connection !== null) {
                $sql = "INSERT INTO monhoc (
                        STT, ma_hp, ten_hp, so_tin_chi, ma_lop_hp, phan_bo_tin_chi,
                        loai_lop, nganh, khoa, chuong_trinh_dao_tao, so_luong_sv,
                        thu, tiet, ngon_ngu_giang_day, giang_duong
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $connection->prepare($sql);
                $stmt->execute([
                    $STT,
                    $maHp,
                    $tenHp,
                    (int)$soTc,
                    $maLopHp,
                    $phanBoTc,
                    $loaiLop,
                    $nganh,
                    $khoa,
                    $chuongTrinhDt,
                    (int)$soLuongSv,
                    $thu,                
                    $tiet,
                    $ngonNguGiangDay,
                    $giangDuong
                ]);
            }
        }
    }
    echo "<pre>";
    //print_r($data);
    echo '<h3 class="text-success">Insert file Successfully!</h3>';
    echo '<a href="monhoc_list.php">Click here to redirect list of file</a>';
    echo "</pre>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel to Read data</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="fileExcel">
        <button type="submit" name="Submit">send</button>

    </form>
</body>

</html>