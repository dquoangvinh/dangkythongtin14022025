<?php
$page_title = "THÊM DANH MỤC MỚI";
$page_subheading = "Điền đầy đủ thông tin và nhấn 'Thêm danh mục' để tạo danh mục mới";
include('template_header.php');
?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-success">
            <div class="panel-heading">
                THÊM DANH MỤC MỚI
            </div>
            <div class="panel-body">
                <form method="POST" action="/WebPHP/tintuc14022025/controller.php">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input class="form-control" type="text" name="category_name" required>
                        <p class="help-block">Nhập tên danh mục bài viết</p>
                    </div>
                    
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="5" name="category_description" required></textarea>
                        <p class="help-block">Nhập mô tả chi tiết về danh mục</p>
                    </div>

                    <button type="submit" name="btn_add_category" class="btn btn-success">
                        <i class="fa fa-plus-circle"></i> Thêm danh mục
                    </button>
                    <a href="category_select.php" class="btn btn-default">
                        <i class="fa fa-arrow-left"></i> Quay lại
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('template_footer.php'); ?>