<?php include '../layouts/header.php'; ?>

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
ơD

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
                            <th>STT</th>
                            <th>Mã học phần</th>
                            <th>Tên học phần</th>
                            <th>Số tín chỉ</th>
                            <th>Phân bố tín chỉ</th>
                            <th>Khoá</th>
                            <th>Thứ</th>
                            <th>Tiết</th>
                            <th>Số lượng sinh viên</th>
                            <th>Giảng đường</th>
                            <th>Ngôn ngữ giảng dạy</th>
                            <th>Giảng viên</th>
                        </tr>
                    </thead>
                    <tbody style="color: #4f535a;">
                        <tr>
                            <td>1</td>
                            <td>HUS1011</td>
                            <td>Tin học cơ sở</td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
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