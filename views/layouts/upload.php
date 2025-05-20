<div class="container" style="max-width: 500px; margin-top: 50px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="height:auto;background-color:blue">
            <h3 class="panel-title" style="font-size: 20px; font-family: Helvetica; color: white;">Chọn thời khoá biểu</h3>
        </div>
        <div class="panel-body" style="height: 165px;">
            <form action="upload_file.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group">
                    <label for="semester" class="col-sm-3 control-label">Học kỳ</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                        <select name="semester" id="semester" class="form-control" required>
                            <option value="">-- Chọn học kỳ --</option>
                            <option value="1">Học kỳ 1</option>
                            <option value="2">Học kỳ 2</option>
                            <option value="3">Học kỳ hè</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="myfile" class="col-sm-3 control-label">Chọn file</label>
                    <div class="col-sm-9">
                        <input type="file" name="myfile" id="myfile" class="form-control" required style="margin-top: 15px;">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-success" style="margin-top: 15px;">Tải lên</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>