<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/style.css">
    <!-- <link rel="stylesheet" href="../../css/search.css"> -->


    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <div id="main" class="container-fluid">
        <div id="header" class="row row1" style="height:150px ">
            <div class="col-sm-2 logo-header" style="background-color:#2e43d1;">
                <img src="https://geology.hus.vnu.edu.vn/wp-content/uploads/2020/03/Logo-HUS_Final-01.png" alt="HUS Logo" " />
            </div>

            <div class="col-sm-5 left-header" style="background-color:rgb(226, 235, 237);margin-left: -10px">
                <div class="header-title" style="color:  #222d94">
                    <h3>

                        CỔNG THÔNG TIN ĐÀO TẠO
                    </h3>
                    <h4>
                        DÀNH CHO <span>
                            GIẢNG VIÊN
                        </span>
                    </h4>
                </div>
            </div>
            <div class="container-fluid col-sm-5 right-header" style="background-color:rgb(226, 235, 237);padding:0;">
                <div class="row row3">
                        <div class=" col-sm-9 headerWelcome">
                            Xin chào bạn:
                            <br>
                            <br>
                            Chọn học kỳ:
                            <select id="cboTerm" name="cboTerm"
                                style="background-color:#b8c4e3;padding:0px 5px;width:190px;clear:both">
                                <option value="242;2;2024-2025">
                                    Mã HK 242 - Học kỳ 2 năm 2024-2025
                                </option>
                                <option value="241;1;2024-2025">
                                    Mã HK 241 - Học kỳ 1 năm 2024-2025
                                </option>
                            </select>
                        </div>
                        <div class=" col-sm-3 avatar-container" id="avatarToggle">
                            <!-- Ảnh avatar -->
                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Avatar"
                                class="avatar" />
                            <!-- Menu dropdown (nội dung thay đổi bằng JS) -->
                            <div class="dropdown" id="dropdownMenu"></div>
                        </div>
                    </div>
                </div>
                <div style="background-color: red;width: 100px;width: 100px; margin-left: auto; padding-right: 0;">
                </div>
            </div>

        </div>
    </div>

    <script src="../../js/script.js"></script>
</body>

</html>