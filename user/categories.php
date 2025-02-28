<?php
include_once('../model.php');

$data = new Content();

// Nếu có ID danh mục, lấy bài viết theo danh mục
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $category_id = $_GET['id'];
    $category = $data->get_category_by_id($category_id);
    
    if (!$category) {
        header('Location: categories.php');
        exit;
    }
    
    $posts = $data->get_posts_by_category($category_id);
    $page_title = htmlspecialchars($category['name']);
} else {
    // Nếu không có ID, hiển thị tất cả danh mục
    $categories = $data->get_all_categories();
    $page_title = "Tất Cả Danh Mục";
}

include('template_header.php');
?>

<?php if (isset($category) && $category): ?>
    <!-- Hiển thị bài viết trong danh mục cụ thể -->
    <h1><?php echo htmlspecialchars($category['name']); ?></h1>
    
    <div class="category-description box">
        <p><?php echo htmlspecialchars($category['description']); ?></p>
    </div>
    
    <ul class="articles box">
        <?php 
        if (count($posts) > 0) {
            foreach ($posts as $post) { 
        ?>
            <li>
                <h2>
                    <a href="post_detail.php?id=<?php echo $post['ID_content']; ?>">
                        <?php echo htmlspecialchars($post['n_title']); ?>
                    </a>
                </h2>
                <div class="article-info box">
                    <p class="f-right">
                        <a href="#" class="comment">Bình luận (0)</a>
                    </p>
                    <p class="f-left">
                        <?php echo date("d/m/Y", strtotime($post['n_date'])); ?> | 
                        Tác giả: <a href="#"><?php echo htmlspecialchars($post['n_author']); ?></a>
                    </p>
                </div>
                
                <div class="box">
                    <p>
                        <img src="/WebPHP/tintuc14022025/uploads/<?php echo basename($post['n_picture']); ?>" 
                             alt="<?php echo htmlspecialchars($post['n_title']); ?>" 
                             class="f-left" style="margin-right: 15px; max-width: 200px;" />
                        <?php echo nl2br(htmlspecialchars($post['n_shortcontent'])); ?>
                    </p>
                </div>
                
                <p class="more">
                    <a href="post_detail.php?id=<?php echo $post['ID_content']; ?>">Đọc tiếp &raquo;</a>
                </p>
            </li>
        <?php 
            }
        } else { 
        ?>
            <li>
                <p>Không có bài viết nào trong danh mục này.</p>
            </li>
        <?php } ?>
    </ul>
    
    <div class="back-link box">
        <p class="more">
            <a href="categories.php">&laquo; Xem tất cả danh mục</a>
        </p>
    </div>
<?php else: ?>
    <!-- Hiển thị tất cả danh mục -->
    <h1>Tất Cả Danh Mục</h1>
    
    <div class="category-list box">
        <?php
        if (mysqli_num_rows($categories) > 0) {
            while ($category = mysqli_fetch_assoc($categories)) {
        ?>
            <div class="category-item box" style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                <h2>
                    <a href="categories.php?id=<?php echo $category['id']; ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </a>
                </h2>
                <p><?php echo htmlspecialchars($category['description']); ?></p>
                <p class="more">
                    <a href="categories.php?id=<?php echo $category['id']; ?>">Xem bài viết trong danh mục này &raquo;</a>
                </p>
            </div>
        <?php
            }
        } else {
        ?>
            <p>Không có danh mục nào.</p>
        <?php
        }
        ?>
    </div>
<?php endif; ?>

<?php include('template_footer.php'); ?>