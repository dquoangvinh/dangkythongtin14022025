<?php
include('../model.php');
$data = new Content();
$categories = $data->get_all_categories();

$page_title = "THÊM BÀI VIẾT MỚI";
$page_subheading = "Điền đầy đủ thông tin và nhấn 'Đăng bài' để thêm bài viết mới";
include('template_header.php');
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                THÊM BÀI VIẾT MỚI
            </div>
            <div class="panel-body">
                <form role="form" method="POST" action="/WebPHP/tintuc14022025/controller.php" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tiêu đề bài viết</label>
                                <input class="form-control" type="text" name="txttitle" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select name="category_id" class="form-control">
                                    <option value="">-- Chọn danh mục --</option>
                                    <?php 
                                    if (mysqli_num_rows($categories) > 0) {
                                        while ($category = mysqli_fetch_assoc($categories)) { 
                                    ?>
                                        <option value="<?php echo $category['id']; ?>">
                                            <?php echo htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Tác giả</label>
                                <input class="form-control" type="text" name="txtauthor" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Ngày đăng</label>
                                <input class="form-control" type="date" name="txtdate" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nội dung ngắn</label>
                                <textarea class="form-control" rows="3" name="txtshort" required></textarea>
                                <p class="help-block">Tóm tắt ngắn gọn nội dung bài viết</p>
                            </div>
                            
                            <div class="form-group">
                                <label>Nội dung đầy đủ</label>
                                <textarea class="form-control" rows="10" name="txtfull" required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input class="form-control" type="file" name="txtfile" required>
                                <p class="help-block">Chọn hình ảnh cho bài viết (JPG, PNG, GIF)</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="btn_upload" class="btn btn-success">
                                <i class="fa fa-upload"></i> Đăng bài
                            </button>
                            <a href="post_select.php" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('template_footer.php'); ?>