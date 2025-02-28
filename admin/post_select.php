<?php
include('../model.php');

$data = new Content();
$posts = $data->select_news();

$page_title = "QUẢN LÝ BÀI VIẾT";
$page_subheading = "Xem tất cả bài viết, chỉnh sửa hoặc xóa bài viết";
include('template_header.php');
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        DANH SÁCH BÀI VIẾT
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="post_add.php" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Thêm bài viết mới
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Hình ảnh</th>
                                <th width="25%">Tiêu đề</th>
                                <th width="15%">Danh mục</th>
                                <th width="10%">Tác giả</th>
                                <th width="10%">Ngày đăng</th>
                                <th width="20%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (mysqli_num_rows($posts) > 0) {
                                while ($row = mysqli_fetch_assoc($posts)) { 
                            ?>
                                <tr>
                                    <td><?php echo $row['ID_content']; ?></td>
                                    <td>
                                        <img src="/WebPHP/tintuc14022025/uploads/<?php echo basename($row['n_picture']); ?>" 
                                            alt="<?php echo htmlspecialchars($row['n_title']); ?>" 
                                            class="img-responsive img-thumbnail" style="max-height: 100px;">
                                    </td>
                                    <td>
                                        <a href="post_detail.php?id=<?php echo $row['ID_content']; ?>">
                                            <?php echo htmlspecialchars($row['n_title']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo isset($row['category_name']) ? htmlspecialchars($row['category_name']) : 'Không có'; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['n_author']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['n_date'])); ?></td>
                                    <td>
                                        <a href="post_detail.php?id=<?php echo $row['ID_content']; ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i> Xem
                                        </a>
                                        <a href="post_update.php?id=<?php echo $row['ID_content']; ?>" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Sửa
                                        </a>
                                        <a href="/WebPHP/tintuc14022025/controller.php?delete_id=<?php echo $row['ID_content']; ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                                            <i class="fa fa-trash"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php 
                                }
                            } else { 
                            ?>
                                <tr>
                                    <td colspan="7" class="text-center">Không có bài viết nào</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('template_footer.php'); ?>