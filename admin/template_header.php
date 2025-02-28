<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo isset($page_title) ? $page_title : 'Hệ thống quản trị tin tức'; ?></title>

    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">HỆ THỐNG TIN TỨC</a>
            </div>

            <div class="header-right">
                <a href="../user/post.php" target="_blank" class="btn btn-primary" title="Xem trang người dùng"><i class="fa fa-desktop fa-2x"></i></a>
                <a href="login.html" class="btn btn-danger" title="Đăng xuất"><i class="fa fa-sign-out fa-2x"></i></a>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="assets/img/user.png" class="img-thumbnail" />
                            <div class="inner-text">
                                Admin
                                <br />
                                <small>Đăng nhập lần cuối: <?php echo date('d/m/Y'); ?></small>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'class="active-menu"' : ''; ?> href="index.php"><i class="fa fa-dashboard"></i>Bảng điều khiển</a>
                    </li>
                    
                    <li>
                        <a <?php echo basename($_SERVER['PHP_SELF']) == 'post_select.php' ? 'class="active-menu"' : ''; ?> href="post_select.php"><i class="fa fa-newspaper-o"></i>Quản lý bài viết</a>
                    </li>
                    
                    <li>
                        <a <?php echo basename($_SERVER['PHP_SELF']) == 'post_add.php' ? 'class="active-menu"' : ''; ?> href="post_add.php"><i class="fa fa-plus-circle"></i>Thêm bài viết</a>
                    </li>
                    
                    <li>
                        <a <?php echo basename($_SERVER['PHP_SELF']) == 'category_select.php' ? 'class="active-menu"' : ''; ?> href="category_select.php"><i class="fa fa-list"></i>Quản lý danh mục</a>
                    </li>
                    
                    <li>
                        <a <?php echo basename($_SERVER['PHP_SELF']) == 'category_add.php' ? 'class="active-menu"' : ''; ?> href="category_add.php"><i class="fa fa-folder-open"></i>Thêm danh mục</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line"><?php echo isset($page_title) ? $page_title : 'QUẢN TRỊ HỆ THỐNG'; ?></h1>
                        <?php if(isset($page_subheading)): ?>
                        <h1 class="page-subhead-line"><?php echo $page_subheading; ?></h1>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /. ROW  -->