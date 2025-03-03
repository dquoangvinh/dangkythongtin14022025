<?php
include_once('../model.php');

$data = new Content();
$posts = $data->get_all_posts();

$page_title = "Trang Chủ";
include('template_header.php');
?>

<h1>Tin Tức Mới Nhất</h1>

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
                    Tác giả: <a href="#"><?php echo htmlspecialchars($post['n_author']); ?></a> | 
                    Danh mục: <a href="categories.php?id=<?php echo $post['category_id']; ?>">
                        <?php echo isset($post['category_name']) ? htmlspecialchars($post['category_name']) : 'Chưa phân loại'; ?>
                    </a>
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
            <p>Không có bài viết nào.</p>
        </li>
    <?php } ?>
</ul>

<?php include('template_footer.php'); ?>