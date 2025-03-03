<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo isset($page_title) ? $page_title . " | SimpleMagazine" : "SimpleMagazine"; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="css/main.css" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="css/skin.css" />
<script type="text/javascript" src="javascript/cufon-yui.js"></script>
<script type="text/javascript" src="javascript/font.font.js"></script>
<script type="text/javascript">
Cufon.replace('h1, h2, h3, h4, h5, h6', {
    hover: true
});
</script>
</head>
<body>
<!-- START PAGE SOURCE -->
<div class="main">
  <div id="header" class="box">
    <h1 id="logo">simple<span>magazine</span></h1>
    <ul id="nav">
      <li <?php echo (basename($_SERVER['PHP_SELF']) == 'post.php' || basename($_SERVER['PHP_SELF']) == 'index.php') ? 'class="current"' : ''; ?>>
        <a href="post.php">Trang chủ</a>
      </li>
      <li <?php echo basename($_SERVER['PHP_SELF']) == 'categories.php' ? 'class="current"' : ''; ?>>
        <a href="categories.php">Danh mục</a>
      </li>
      <li <?php echo basename($_SERVER['PHP_SELF']) == 'post_detail.php' ? 'class="current"' : ''; ?>>
        <a href="#">Bài viết</a>
      </li>
      <li><a href="../admin/index.php">Quản trị</a></li>
    </ul>
  </div>
  <div id="section" class="box">
    <div id="content">