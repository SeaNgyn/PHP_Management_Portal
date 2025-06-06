<?php include '../layouts/header.php'; ?>
<?php
include '../../configuration/database.php';
try {
    $sql = "SELECT * FROM mon_hoc;";
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
    <div class="col-sm-10 content" style="background-color:rgb(252, 252, 252);padding:0">
        <div id="modTitle" class="module-title" style="height:25px; ;">Hồ sơ</div>
        <div class="container">
            <form class="form-horizontal">
                <fieldset>
                    <legend>Thông tin cá nhân</legend>
                    <!-- Ảnh bên trái -->
                    <div class="col-sm-4 text-center" style="width: 300px;">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Ảnh cá nhân"
                            class="img-thumbnail profile-img">
                        <br>
                        <!-- Input ẩn để chọn ảnh -->
                        <input type="file" id="imageUpload" accept="image/*" style="display: none;">

                        <!-- Link để kích hoạt input file -->
                        <a href="#" onclick="document.getElementById('imageUpload').click(); return false;">Cập nhật
                            ảnh</a>
                    </div>

                    <!-- Thông tin bên phải -->
                    <div class="col-sm-8" style="width: 600px;margin-left:-25px">
                        <div class="form-group" style="margin-bottom: auto">
                            <label class="col-sm-3 control-label">Mã giảng viên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="" disabled>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: auto">
                            <label class="col-sm-3 control-label">Họ và tên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: auto">
                            <label class="col-sm-3 control-label">Ngày sinh</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" value="">
                            </div>

                            <label class="col-sm-2 control-label">Giới tính</label>
                            <div class="col-sm-3">
                                <select class="form-control">
                                    <option value="">-- Chọn --</option>
                                    <option value="0">Nam</option>
                                    <option value="1" selected>Nữ</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: auto">
                            <label class="col-sm-3 control-label">Quê quán </label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" value="21000772@vnu.edu.vn">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" value="ngantrang0316@gmail.com">
                            </div>
                        </div>
                    </div>

                </fieldset>
                <fieldset>
                    <legend>Thông tin cơ bản</legend>
                    <!-- Ảnh bên trái -->
                
                    <!-- Thông tin bên phải -->
                    <div class="col-sm-8" style="width: 600px;margin-left:-25px">
                        <div class="form-group" style="margin-bottom: auto">
                            <label class="col-sm-3 control-label">Học hàm</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="" disabled>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: auto">
                            <label class="col-sm-3 control-label">Học vị</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: auto">
                            <label class="col-sm-3 control-label">Bộ môn </label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" value="21000772@vnu.edu.vn">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Chức vụ</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" value="ngantrang0316@gmail.com">
                            </div>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>

    </div>
</div>
</div>