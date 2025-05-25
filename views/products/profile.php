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
    <div class="col-sm-10 content" style="background-color:rgb(252, 252, 252);padding:0">
        <div id="modTitle" class="module-title" style="height:25px; ;">Hồ sơ</div>
        <div class="row row4" style="margin-left:0; width:100%">
            <!-- <table class="tabbox" style=" border:0 ;align:center;" width="100%" cellspacing="0" cellpadding="8" ></table> -->
            <div class="col-sm-8">
                <form class="form-horizontal">
                    <fieldset>
                        <legend><strong style="font-size: 15px;">Thông tin cá nhân</strong></legend>

                        <div class="form-group">
                            <div class="col-sm-4 text-center">
                                <img id="piccy" class="img-thumbnail"
                                    src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                    alt="Ảnh" height="130">
                                <br>
                                <a href="#">Cập nhật ảnh</a>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Mã sinh viên</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="21000772" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Họ và tên</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="Nguyễn Thị Trang Ngân" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Ngày sinh</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" value="01/06/2003" disabled>
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

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email ĐHQGHN</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" value="21000772@vnu.edu.vn">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email khác</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" value="ngantrang0316@gmail.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>