<?php
include('../model.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: post_select.php');
    exit;
}

$data = new Content();
$post = $data->get_news_by_id($_GET['id']);
$categories = $data->get_all_categories();

if (!$post) {
    header('Location: post_select.php');
    exit;
}

$page_title = "CẬP NHẬT BÀI VIẾT";
$page_subheading = "Chỉnh sửa thông tin bài viết: " . htmlspecialchars($post['n_title']);
include('template_header.php');
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                CẬP NHẬT BÀI VIẾT
            </div>
            <div class="panel-body">
                <form role="form" method="POST" action="/WebPHP/tintuc14022025/controller.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $post['ID_content']; ?>">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tiêu đề bài viết</label>
                                <input class="form-control" type="text" name="txttitle" value="<?php echo htmlspecialchars($post['n_title']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select name="category_id" class="form-control">
                                    <option value="">-- Chọn danh mục --</option>
                                    <?php 
                                    if (mysqli_num_rows($categories) > 0) {
                                        while ($category = mysqli_fetch_assoc($categories)) { 
                                    ?>
                                        <option value="<?php echo $category['id']; ?>" <?php echo (isset($post['category_id']) && $post['category_id'] == $category['id']) ? 'selected' : ''; ?>>
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
                                <input class="form-control" type="text" name="txtauthor" value="<?php echo htmlspecialchars($post['n_author']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Ngày đăng</label>
                                <input class="form-control" type="date" name="txtdate" value="<?php echo date('Y-m-d', strtotime($post['n_date'])); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Hình ảnh hiện tại</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="/WebPHP/tintuc14022025/uploads/<?php echo basename($post['n_picture']); ?>" 
                                            alt="<?php echo htmlspecialchars($post['n_title']); ?>" 
                                            class="img-responsive img-thumbnail" style="max-width: 100%;">
                                    </div>
                                </div>
                                <input type="hidden" name="current_image" value="<?php echo $post['n_picture']; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Thay đổi hình ảnh (để trống nếu giữ nguyên)</label>
                                <input class="form-control" type="file" name="txtfile">
                                <p class="help-block">Chọn hình ảnh mới nếu muốn thay đổi</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nội dung ngắn</label>
                                <textarea class="form-control" rows="5" name="txtshort" required><?php echo htmlspecialchars($post['n_shortcontent']); ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Nội dung đầy đủ</label>
                                <textarea class="form-control" rows="15" name="txtfull" required><?php echo htmlspecialchars($post['n_longcontent']); ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="btn_update" class="btn btn-primary">
                                <i class="fa fa-save"></i> Cập nhật
                            </button>
                            <a href="post_detail.php?id=<?php echo $post['ID_content']; ?>" class="btn btn-info">
                                <i class="fa fa-eye"></i> Xem chi tiết
                            </a>
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