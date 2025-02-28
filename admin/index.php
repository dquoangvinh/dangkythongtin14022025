<?php
include('../model.php');

$data = new Content();

// Lấy tổng số bài viết
$posts_result = $data->select_news();
$total_posts = mysqli_num_rows($posts_result);

// Lấy tổng số danh mục
$categories_result = $data->get_all_categories();
$total_categories = mysqli_num_rows($categories_result);

// Lấy bài viết mới nhất
$latest_posts = $data->get_all_posts();
$latest_posts = array_slice($latest_posts, 0, 5);

$page_title = "BẢNG ĐIỀU KHIỂN";
$page_subheading = "Tổng quan về hệ thống quản trị tin tức";
include('template_header.php');
?>

<div class="row">
    <div class="col-md-4">
        <div class="main-box mb-red">
            <a href="post_select.php">
                <i class="fa fa-newspaper-o fa-5x"></i>
                <h5><?php echo $total_posts; ?> Bài Viết</h5>
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="main-box mb-dull">
            <a href="category_select.php">
                <i class="fa fa-list fa-5x"></i>
                <h5><?php echo $total_categories; ?> Danh Mục</h5>
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="main-box mb-pink">
            <a href="post_add.php">
                <i class="fa fa-plus-circle fa-5x"></i>
                <h5>Thêm Bài Viết Mới</h5>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                BÀI VIẾT MỚI NHẤT
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Danh mục</th>
                                <th>Tác giả</th>
                                <th>Ngày đăng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (count($latest_posts) > 0) {
                                foreach ($latest_posts as $post) { 
                            ?>
                                <tr>
                                    <td><?php echo $post['ID_content']; ?></td>
                                    <td>
                                        <a href="post_detail.php?id=<?php echo $post['ID_content']; ?>">
                                            <?php echo htmlspecialchars($post['n_title']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo isset($post['category_name']) ? htmlspecialchars($post['category_name']) : 'Không có'; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($post['n_author']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($post['n_date'])); ?></td>
                                    <td>
                                        <a href="post_detail.php?id=<?php echo $post['ID_content']; ?>" class="btn btn-info btn-xs">
                                            <i class="fa fa-eye"></i> Xem
                                        </a>
                                        <a href="post_update.php?id=<?php echo $post['ID_content']; ?>" class="btn btn-primary btn-xs">
                                            <i class="fa fa-edit"></i> Sửa
                                        </a>
                                    </td>
                                </tr>
                            <?php 
                                }
                            } else { 
                            ?>
                                <tr>
                                    <td colspan="6" class="text-center">Không có bài viết nào</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                THỐNG KÊ HỆ THỐNG
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="post_select.php" class="list-group-item">
                        <i class="fa fa-newspaper-o fa-fw"></i> Tổng số bài viết
                        <span class="pull-right text-muted small"><em><?php echo $total_posts; ?></em></span>
                    </a>
                    <a href="category_select.php" class="list-group-item">
                        <i class="fa fa-list fa-fw"></i> Tổng số danh mục
                        <span class="pull-right text-muted small"><em><?php echo $total_categories; ?></em></span>
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-user fa-fw"></i> Người quản trị
                        <span class="pull-right text-muted small"><em>Admin</em></span>
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-calendar fa-fw"></i> Thời gian hiện tại
                        <span class="pull-right text-muted small"><em><?php echo date('d/m/Y H:i'); ?></em></span>
                    </a>
                </div>
                <a href="#" class="btn btn-info btn-block">Xem tất cả hoạt động</a>
            </div>
        </div>
        
        <div class="panel panel-success">
            <div class="panel-heading">
                ĐƯỜNG DẪN NHANH
            </div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <a href="post_add.php"><i class="fa fa-plus-circle fa-fw"></i> Thêm bài viết mới</a>
                    </li>
                    <li>
                        <a href="category_add.php"><i class="fa fa-folder-open fa-fw"></i> Thêm danh mục mới</a>
                    </li>
                    <li>
                        <a href="../user/post.php" target="_blank"><i class="fa fa-desktop fa-fw"></i> Xem trang người dùng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include('template_footer.php'); ?>