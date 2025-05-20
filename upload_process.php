<?php
set_time_limit(0);
ob_start();

require 'vendor/autoload.php';
include './configuration/database.php';
libxml_use_internal_errors(true);

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_FILES['fileExcel']['error'] !== UPLOAD_ERR_OK) {
    die("File upload failed.");
}

$file = $_FILES['fileExcel']['tmp_name'];
$spreadsheet = IOFactory::load($file);
$sheetCount = $spreadsheet->getSheetCount();

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
    'tenGv' => ['Họ tên GV'],
    'namSinhGv' => ['Empty'],
    'hocViGv' => ['Họchàm/họcvị'],
    'emailGv' => ['Empty'],
    'sdtGv' => ['Empty'],
    'khoaGv' => ['Khoa']



];

function getCellValue($rowData, $indexResult, $key)
{
    // nếu không tìm thấy key trong indexResult, trả null
    if (!isset($indexResult[$key])) {
        return null;
    }
    // nếu ô rỗng hoặc không tồn tại, trả null
    $val = $rowData[$indexResult[$key]] ?? null;
    if ($val === "" || $val === null) {
        return null;
    }
    return $val;
}

$inserted = 0;
for ($s = 0; $s < $sheetCount; $s++) {
    $sheet = $spreadsheet->getSheet($s);
    $data = $sheet->toArray();

    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';


    // Tìm cột theo tiêu đề
    $indexResult = [];
    foreach ($data as $rowIndex => $row) {
        foreach ($row as $i => $cellValue) {
            foreach ($columnIndexes as $key => $aliases) {
                if (in_array(trim($cellValue), $aliases)) {
                    $indexResult[$key] = $i;
                }
            }
        }
        if (!empty($indexResult)) {
            $headerRowIndex = $rowIndex;
            break;
        }
    }


    // Duyệt dữ liệu từ dòng tiếp theo
    $total = count($data);
    // echo '<pre>';
    // print_r($hello);
    // echo '</pre>';

    for ($i = $headerRowIndex + 1; $i < $total; $i++) {
        $intFields = [
            (int)getCellValue($data[$i], $indexResult, "STT"),
            (int)getCellValue($data[$i], $indexResult, "soTc"),
            (int)getCellValue($data[$i], $indexResult, "soLuongSv"),
        ];

        $stringFields = [
            getCellValue($data[$i], $indexResult, "maHp"),
            getCellValue($data[$i], $indexResult, "tenHp"),
            getCellValue($data[$i], $indexResult, "maLopHp"),
            getCellValue($data[$i], $indexResult, "phanBoTc"),
            getCellValue($data[$i], $indexResult, "loaiLop"),
            getCellValue($data[$i], $indexResult, "nganh"),
            getCellValue($data[$i], $indexResult, "khoa"),
            getCellValue($data[$i], $indexResult, "chuongTrinhDt"),
            getCellValue($data[$i], $indexResult, "thu"),
            getCellValue($data[$i], $indexResult, "tiet"),
            getCellValue($data[$i], $indexResult, "ngonNguGiangDay"),
            getCellValue($data[$i], $indexResult, "giangDuong")
            // getCellValue($data[$i], $indexResult, "tenGv"),
            // getCellValue($data[$i], $indexResult, "namSinhGv"),
            // getCellValue($data[$i], $indexResult, "hocViGv"),
            // getCellValue($data[$i], $indexResult, "emailGv"),
            // getCellValue($data[$i], $indexResult, "sdtGv"),
            // getCellValue($data[$i], $indexResult, "khoaGv")
        ];

        $stringFieldsGv = [
            getCellValue($data[$i], $indexResult, "tenGv"),
            getCellValue($data[$i], $indexResult, "namSinhGv"),
            getCellValue($data[$i], $indexResult, "hocViGv"),
            getCellValue($data[$i], $indexResult, "emailGv"),
            getCellValue($data[$i], $indexResult, "sdtGv"),
            getCellValue($data[$i], $indexResult, "khoaGv")
        ];

        // Kiểm tra xem tất cả giá trị có phải đều rỗng/0 không
        $hasValidInt = array_filter($intFields, fn($v) => $v !== null && $v != 0);
        $hasValidString = array_filter($stringFields, fn($v) => $v !== null && trim($v) !== "");
        $hasValidStringGv = array_filter($stringFieldsGv, fn($v) => $v !== null && trim($v) !== "");

        if (!empty($hasValidInt) || !empty($hasValidString)) {
            $values = [
                $intFields[0],                    // STT
                $stringFields[0],                 // ma_hp
                $stringFields[1],                 // ten_hp
                $intFields[1],                    // so_tin_chi
                $stringFields[2],                 // ma_lop_hp
                $stringFields[3],                 // phan_bo_tin_chi
                $stringFields[4],                 // loai_lop
                $stringFields[5],                 // nganh
                $stringFields[6],                 // khoa
                $stringFields[7],                 // chuong_trinh_dao_tao
                $intFields[2],                    // so_luong_sv
                $stringFields[8],                 // thu
                $stringFields[9],                 // tiet
                $stringFields[10],                // ngon_ngu_giang_day
                $stringFields[11]                 // giang duong
            ];

            $values1 = [
                $stringFieldsGv[0],                // ten giang vien
                $stringFieldsGv[1],                // nam sinh giang vien
                $stringFieldsGv[2],                // hoc vi giang vien
                $stringFieldsGv[3],                // email giang vien
                $stringFieldsGv[4],                // sdt giang vien
                $stringFieldsGv[5]                 // khoa cua giang vien
            ];
        
            if ($connection !== null) {
                $stmt = $connection->prepare("INSERT INTO monhoc (
                STT, ma_hp, ten_hp, so_tin_chi, ma_lop_hp, phan_bo_tin_chi,
                loai_lop, nganh, khoa, chuong_trinh_dao_tao, so_luong_sv,
                thu, tiet, ngon_ngu_giang_day, giang_duong
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->execute($values);
                $lastMonhocId = $connection->lastInsertId(); // lấy id môn học vừa thêm

                if (!empty($values1[0])) {
                    $stmt1 = $connection->prepare("INSERT INTO giangvien (
                    ten, nam_sinh, hoc_vi, email, sdt, khoa
                    ) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt2 = $connection->prepare("INSERT INTO giangvien_monhoc (
                    id_giangvien, id_monhoc
                    ) VALUES (?, ?)");

                    $stmt1->execute($values1);

                    $lastGiangvienId = $connection->lastInsertId(); // lấy id giảng viên vừa thêm
                    
                    $stmt2->execute([$lastGiangvienId, $lastMonhocId]);// Insert vào bảng trung gian
                }

                $inserted++;
            }
        }
    }
}




echo "<h3>Đã xử lý thành công $inserted dòng từ tất cả các sheet.</h3>";
echo '<a href="monhoc_list.php">Chuyển đến danh sách</a>';
