<?php
include_once('../model.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: post.php');
    exit;
}

$data = new Content();
$post = $data->get_news_by_id($_GET['id']);

if (!$post) {
    header('Location: post.php');
    exit;
}

$page_title = htmlspecialchars($post['n_title']);
include('template_header.php');
?>

<h1><?php echo htmlspecialchars($post['n_title']); ?></h1>

<div class="article-info box">
    <p class="f-right">
        <a href="#" class="comment">Bình luận (0)</a>
    </p>
    <p class="f-left">
        <?php echo date("d/m/Y", strtotime($post['n_date'])); ?> | 
        Tác giả: <a href="#"><?php echo htmlspecialchars($post['n_author']); ?></a> | 
        Danh mục: <a href="categories.php?id=<?php echo $post['category_id']; ?>">
            <?php echo isset($post['category_name']) ? htmlspecialchars($post['category_name']) : 'Chưa phân loại'; ?>
        </a>
    </p>
</div>

<div class="article-content box">
    <!-- Hình ảnh -->
    <p class="text-center" style="margin: 20px 0;">
        <img src="/WebPHP/tintuc14022025/uploads/<?php echo basename($post['n_picture']); ?>" 
             alt="<?php echo htmlspecialchars($post['n_title']); ?>" 
             style="max-width: 100%; margin: 0 auto;" />
    </p>
    
    <!-- Nội dung ngắn -->
    <div class="intro-text">
        <h3>Tóm tắt</h3>
        <p><?php echo nl2br(htmlspecialchars($post['n_shortcontent'])); ?></p>
    </div>
    
    <!-- Nội dung chi tiết -->
    <div class="full-content">
        <h3>Nội dung chi tiết</h3>
        <?php echo nl2br(htmlspecialchars($post['n_longcontent'])); ?>
    </div>
</div>

<div class="back-link box">
    <p class="more">
        <a href="post.php">&laquo; Quay lại trang chủ</a>
    </p>
</div>

<?php include('template_footer.php'); ?>