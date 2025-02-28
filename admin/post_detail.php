<?php
include('../model.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: post_select.php');
    exit;
}

$data = new Content();
$post = $data->get_news_by_id($_GET['id']);

if (!$post) {
    header('Location: post_select.php');
    exit;
}

$page_title = "CHI TIẾT BÀI VIẾT";
$page_subheading = htmlspecialchars($post['n_title']);
include('template_header.php');
?>

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="post_update.php?id=<?php echo $post['ID_content']; ?>" class="btn btn-primary">
            <i class="fa fa-edit"></i> Chỉnh sửa
        </a>
        <a href="post_select.php" class="btn btn-default">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo htmlspecialchars($post['n_title']); ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="well">
                            <h4>Nội dung ngắn:</h4>
                            <p><?php echo nl2br(htmlspecialchars($post['n_shortcontent'])); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <h4>Nội dung đầy đủ:</h4>
                        <div class="well" style="background-color: #fff;">
                            <?php echo nl2br(htmlspecialchars($post['n_longcontent'])); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info-circle"></i> Thông tin bài viết</h3>
            </div>
            <div class="panel-body">
                <div class="text-center mb-3">
                    <img src="/WebPHP/tintuc14022025/uploads/<?php echo basename($post['n_picture']); ?>" 
                         alt="<?php echo htmlspecialchars($post['n_title']); ?>" 
                         class="img-responsive img-thumbnail" style="max-width: 100%; margin: 0 auto;">
                </div>
                
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">ID</th>
                        <td><?php echo $post['ID_content']; ?></td>
                    </tr>
                    <tr>
                        <th>Danh mục</th>
                        <td><?php echo isset($post['category_name']) ? htmlspecialchars($post['category_name']) : 'Không có'; ?></td>
                    </tr>
                    <tr>
                        <th>Tác giả</th>
                        <td><?php echo htmlspecialchars($post['n_author']); ?></td>
                    </tr>
                    <tr>
                        <th>Ngày đăng</th>
                        <td><?php echo date('d/m/Y', strtotime($post['n_date'])); ?></td>
                    </tr>
                </table>
                
                <div class="text-center">
                    <a href="/WebPHP/tintuc14022025/controller.php?delete_id=<?php echo $post['ID_content']; ?>" 
                       class="btn btn-danger"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                        <i class="fa fa-trash"></i> Xóa bài viết
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('template_footer.php'); ?>