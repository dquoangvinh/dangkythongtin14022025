    </div>
    <div id="aside">
      <form action="#" method="get" id="search">
        <p>
          <input type="text" size="20" class="input-text" value="Tìm kiếm..." onfocus="if(this.value=='Tìm kiếm...') this.value=''" />
          <input type="submit" value="Tìm" class="input-submit" />
        </p>
      </form>
      <h3>Danh Mục</h3>
      <ul class="menu">
        <?php
        include_once('../model.php');
        $cat_data = new Content();
        $categories = $cat_data->get_all_categories();
        if (mysqli_num_rows($categories) > 0) {
          while($category = mysqli_fetch_assoc($categories)) {
        ?>
          <li>
            <a href="categories.php?id=<?php echo $category['id']; ?>">
              <?php echo htmlspecialchars($category['name']); ?>
            </a>
          </li>
        <?php
          }
        }
        ?>
      </ul>
      
      <h3>Bài Viết Mới Nhất</h3>
      <?php
      $recent_data = new Content();
      $recent_posts = $recent_data->get_all_posts();
      $recent_posts = array_slice($recent_posts, 0, 3);
      
      if (count($recent_posts) > 0) {
      ?>
      <ul class="sponsors">
        <?php
        foreach ($recent_posts as $post) {
        ?>
        <li>
          <a href="post_detail.php?id=<?php echo $post['ID_content']; ?>">
            <?php echo htmlspecialchars($post['n_title']); ?>
          </a><br />
          <?php echo substr(htmlspecialchars($post['n_shortcontent']), 0, 70) . '...'; ?>
        </li>
        <?php
        }
        ?>
      </ul>
      <?php
      }
      ?>
    </div>
  </div>
</div>
<div id="footer">
  <div class="main box">
    <p class="f-right t-right">Thiết kế bởi <a href="#">SimpleMagazine</a></p>
    <p class="f-left">Copyright &copy;&nbsp;<?php echo date('Y'); ?> <a href="#">SimpleMagazine</a></p>
  </div>
</div>
<script type="text/javascript">Cufon.now();</script>
<!-- END PAGE SOURCE -->
</body>
</html>