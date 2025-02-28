<?php
include('../model.php');

$data = new Content();
$categories = $data->get_all_categories();

$page_title = "QUẢN LÝ DANH MỤC";
$page_subheading = "Xem tất cả danh mục, chỉnh sửa hoặc xóa danh mục";
include('template_header.php');
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        DANH SÁCH DANH MỤC
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="category_add.php" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Thêm danh mục mới
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="25%">Tên danh mục</th>
                                <th width="45%">Mô tả</th>
                                <th width="20%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($categories) > 0) {
                                while ($row = mysqli_fetch_assoc($categories)) { 
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm view-category" data-id="<?php echo $row['id']; ?>" 
                                            data-name="<?php echo htmlspecialchars($row['name']); ?>"
                                            data-description="<?php echo htmlspecialchars($row['description']); ?>">
                                            <i class="fa fa-eye"></i> Xem
                                        </button>
                                        <button class="btn btn-primary btn-sm edit-category" data-id="<?php echo $row['id']; ?>"
                                            data-name="<?php echo htmlspecialchars($row['name']); ?>"
                                            data-description="<?php echo htmlspecialchars($row['description']); ?>">
                                            <i class="fa fa-edit"></i> Sửa
                                        </button>
                                        <a href="/WebPHP/tintuc14022025/controller.php?delete_category_id=<?php echo $row['id']; ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                            <i class="fa fa-trash"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php 
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="4" class="text-center">Không có danh mục nào.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal hiển thị/chỉnh sửa danh mục -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="categoryModalLabel">Chi tiết danh mục</h4>
            </div>
            <div class="modal-body">
                <form id="categoryForm" method="POST" action="/WebPHP/tintuc14022025/controller.php">
                    <input type="hidden" name="category_id" id="category_id">
                    
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input class="form-control" type="text" name="category_name" id="category_name" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="5" name="category_description" id="category_description" required></textarea>
                    </div>
                    
                    <div id="submit_btn_area">
                        <button type="submit" name="btn_update_category" class="btn btn-primary">
                            <i class="fa fa-save"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Xử lý khi nhấn vào nút Xem
    $('.view-category').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var description = $(this).data('description');
        
        $('#category_id').val(id);
        $('#category_name').val(name);
        $('#category_description').val(description);
        
        // Đặt chế độ chỉ đọc
        $('#category_name').attr('readonly', 'readonly');
        $('#category_description').attr('readonly', 'readonly');
        $('#submit_btn_area').hide();
        
        // Hiển thị modal
        $('#categoryModalLabel').text('Chi tiết danh mục');
        $('#categoryModal').modal('show');
    });
    
    // Xử lý khi nhấn vào nút Sửa
    $('.edit-category').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var description = $(this).data('description');
        
        $('#category_id').val(id);
        $('#category_name').val(name);
        $('#category_description').val(description);
        
        // Cho phép chỉnh sửa
        $('#category_name').removeAttr('readonly');
        $('#category_description').removeAttr('readonly');
        $('#submit_btn_area').show();
        
        // Hiển thị modal
        $('#categoryModalLabel').text('Chỉnh sửa danh mục');
        $('#categoryModal').modal('show');
    });
});
</script>

<?php include('template_footer.php'); ?>