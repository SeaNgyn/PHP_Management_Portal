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

    
    $columnIndexes = [
        'STT' => ['STT'],
        'maHp' => ['MHP', 'Mã học phần'],
        'tenHp' => ['Tên HP', 'Học phần'],
        'soTc' => ['STC', 'Số TC'],
        'maLopHp' => ['Mã lớp học phần', 'Mã LHP'],
        'phanBoTc' => ['Phân bổ TC'],
        'loaiLop' => ['LT, TH/BT, TH'],
        'nganh' => ['Ngành'],
        'khoa' => ['Khoa'],
        'chuongTrinhDt' => ['CTĐT'],
        'soLuongSv' => ['Số SV đang học', 'Số ĐK'],
        'thu' => ['Thứ'],
        'tiet' => ['Tiết'],
        'ngonNguGiangDay' => ['Ngôn ngữ giảng dạy'],
        'giangDuong' => ['Giảng đường'],
    ];
    
    $indexResult = []; // lưu kết quả chỉ số cột
    
    // tìm dòng tiêu đề chứa các nhãn cột
    foreach ($data as $row) {
        foreach ($row as $i => $cellValue) {
            foreach ($columnIndexes as $key => $aliases) {
                if (in_array(trim($cellValue), $aliases)) {
                    $indexResult[$key] = $i;
                }
            }
        }
        // Nếu đã tìm thấy ít nhất 1 nhãn thì dừng (tránh duyệt nhiều dòng)
        if (!empty($indexResult)) {
            break;
        }
    }
    
    // $STT = "";
    // $maHp = "";
    // $tenHp = "";
    // $soTc = "";
    // $maLopHp = "";
    // $phanBoTc = "";
    // $loaiLop = "";
    // $nganh = "";
    // $khoa = "";
    // $chuongTrinhDt = "";
    // $soLuongSv = "";
    // $thu = "";
    // $tiet = "";
    // $ngonNguGiangDay = "";
    // $giangDuong = "";

    // for ($row = 0; $row < count($data); $row++) {
    //     for ($i = 0; $i < count($data[$row]); $i++) {
    //         if ($data[$row][$i] == "STT") {
    //             $STT = $i;
    //         }
    //         if ($data[$row][$i] == "MHP" || $data[$row][$i] == "Mã học phần") {
    //             $maHp = $i;
    //         }
    //         if ($data[$row][$i] == "Tên HP" || $data[$row][$i] == "Học phần") {
    //             $tenHp = $i;
    //         }
    //         if ($data[$row][$i] == "STC" || $data[$row][$i] == "Số TC") {
    //             $soTc = $i;
    //         }
    //         if ($data[$row][$i] == "Mã lớp học phần" || $data[$row][$i] == "Mã LHP") {
    //             $maLopHp = $i;
    //         }
    //         if ($data[$row][$i] == "Phân bổ TC") {
    //             $phanBoTc = $i;
    //         }
    //         if ($data[$row][$i] == "LT, TH/BT, TH") {
    //             $loaiLop = $i;
    //         }
    //         if ($data[$row][$i] == "Ngành") {
    //             $nganh = $i;
    //         }
    //         if ($data[$row][$i] == "Khoa") {
    //             $khoa = $i;
    //         }
    //         if ($data[$row][$i] == "CTĐT") {
    //             $chuongTrinhDt = $i;
    //         }
    //         if ($data[$row][$i] == "Số SV đang học" || $data[$row][$i] == "Số ĐK") {
    //             $soLuongSv = $i;
    //         }
    //         if ($data[$row][$i] == "Thứ") {
    //             $thu = $i;
    //         }
    //         if ($data[$row][$i] == "Tiết") {
    //             $tiet = $i;
    //         }
    //         if ($data[$row][$i] == "Ngôn ngữ giảng dạy") {
    //             $ngonNguGiangDay = $i;
    //         }
    //         if ($data[$row][$i] == "Giảng đường") {
    //             $giangDuong = $i;
    //         }
    //     }
    // }

    // echo "<br>";
    // echo "stt: " . ($STT ?? 'không tìm thấy') . "<br>";
    // echo "ma hoc phan: " . ($maHp ?? 'không tìm thấy') . "<br>";
    // echo "Ten hp: " . ($tenHp ?? 'không tìm thấy') . "<br>";
    // echo "so tin chi: " . ($soTc ?? 'không tìm thấy') . "<br>";
    // echo "maLopHp: " . ($maLopHp ?? 'không tìm thấy') . "<br>";
    // echo "phanBoTc: " . ($phanBoTc ?? 'không tìm thấy') . "<br>";
    // echo "loaiLop: " . ($loaiLop ?? 'không tìm thấy') . "<br>";
    // echo "nganh: " . ($nganh ?? 'không tìm thấy') . "<br>";
    // echo "khoa: " . ($khoa ?? 'không tìm thấy') . "<br>";
    // echo "chuongTrinhDt: " . ($chuongTrinhDt ?? 'không tìm thấy') . "<br>";
    // echo "soLuongSv: " . ($soLuongSv ?? 'không tìm thấy') . "<br>";
    // echo "thu: " . ($thu ?? 'không tìm thấy') . "<br>";
    // echo "tiet: " . ($tiet ?? 'không tìm thấy') . "<br>";
    // echo "ngonNguGiangDay: " . ($ngonNguGiangDay ?? 'không tìm thấy') . "<br>";
    // echo "giangDuong: " . ($giangDuong ?? 'không tìm thấy') . "<br>";
    
    for ($row = 0; $row <= count($data) - 1; $row++) {
        if (!is_numeric($data[$row]['0'])) {
            continue; // bỏ qua nếu không phải số
        } else {
            $STT = $data[$row][$indexResult["STT"]] ?? "";
            $maHp = $data[$row][$indexResult["maHp"]] ?? "";
            $tenHp = $data[$row][$indexResult["tenHp"]] ?? "";
            $soTc = $data[$row][$indexResult["soTc"]] ?? "";
            $maLopHp = $data[$row][$indexResult["maLopHp"]] ?? "";
            $phanBoTc = $data[$row][$indexResult["phanBoTc"]] ?? "";
            $loaiLop = $data[$row][$indexResult["loaiLop"]] ?? "";
            $nganh = $data[$row][$indexResult["nganh"]] ?? "";
            $khoa = $data[$row][$indexResult["khoa"]] ?? "";
            $chuongTrinhDt = $data[$row][$indexResult["chuongTrinhDt"]] ?? "";
            $soLuongSv = $data[$row][$indexResult["soLuongSv"]] ?? "";
            $thu = $data[$row][$indexResult["thu"]] ?? "";
            $tiet = $data[$row][$indexResult["tiet"]] ?? "";
            $ngonNguGiangDay = $data[$row][$indexResult["ngonNguGiangDay"]] ?? "";
            $giangDuong = $data[$row][$indexResult["giangDuong"]] ?? "";

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