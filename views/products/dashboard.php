<?php include '../layouts/header.php'; ?>

<div id="divMain" class="row row2">
    <div class="col-sm-2 sidebar" style="background-color:#2e43d1;padding-right: 0">
        <?php include '../layouts/sidebar.php'; ?>
    </div>
    <div class="col-sm-10 content" style="background-color:rgb(252, 252, 252);">
        <div id="modTitle" class="module-title" style="height:25px;margin-left:-15px;">Giảng dạy</div>
        <?php include '../layouts/upload.php'; ?>
        <?php include '../layouts/dash.php'; ?>
        <!-- Phân trang -->
       <div style="text-align: center;">
       <ul class="pagination">
            <li class="disabled"><a href="#">«</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">»</a></li>
        </ul>
       </div>
    </div>
</div>
<script src="../../js/dash.js"></script>
