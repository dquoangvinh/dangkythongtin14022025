<?php
include('model.php');

$data = new Content();

// XỬ LÝ THÊM BÀI VIẾT
if (isset($_POST['btn_upload'])) {
    $tieude = $_POST['txttitle'];
    $noidungngan = $_POST['txtshort'];
    $noidungdu = $_POST['txtfull'];
    $tacgia = $_POST['txtauthor'];
    $ngay = $_POST['txtdate'];
    $category_id = isset($_POST['category_id']) && !empty($_POST['category_id']) ? $_POST['category_id'] : null;

    // Xử lý upload ảnh
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Tạo thư mục nếu chưa tồn tại
    }

    $anh = basename($_FILES["txtfile"]["name"]);
    $target_file = $target_dir . $anh;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    // Kiểm tra MIME type của ảnh
    $check = getimagesize($_FILES["txtfile"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File không phải là ảnh hợp lệ');</script>";
        exit();
    }

    // Kiểm tra phần mở rộng file
    if (!in_array($imageFileType, $allowed_types)) {
        echo "<script>alert('Chỉ hỗ trợ file ảnh JPG, JPEG, PNG, GIF');</script>";
        exit();
    }

    if (move_uploaded_file($_FILES["txtfile"]["tmp_name"], $target_file)) {
        $themmoinews = $data->add_news($tieude, $noidungngan, $noidungdu, $tacgia, $ngay, $target_file, $category_id);
        if ($themmoinews) {
            echo "<script>
                alert('Bài viết đã được thêm mới!');
                window.location.href = '/WebPHP/tintuc14022025/admin/post_select.php';
              </script>";
        } else {
            echo "<script>alert('Bài viết chưa được thêm mới');</script>";
        }
    } else {
        echo "<script>alert('Lỗi upload ảnh! Kiểm tra quyền thư mục uploads.');</script>";
    }
}

// XỬ LÝ CẬP NHẬT BÀI VIẾT
if (isset($_POST['btn_update'])) {
    $id = $_POST['id'];
    $tieude = $_POST['txttitle'];
    $noidungngan = $_POST['txtshort'];
    $noidungdu = $_POST['txtfull'];
    $tacgia = $_POST['txtauthor'];
    $ngay = $_POST['txtdate'];
    $category_id = isset($_POST['category_id']) && !empty($_POST['category_id']) ? $_POST['category_id'] : null;

    // Xử lý upload ảnh
    if (!empty($_FILES['txtfile']['name'])) {
        $target_dir = "uploads/";
        $anh = $target_dir . basename($_FILES["txtfile"]["name"]);
        move_uploaded_file($_FILES["txtfile"]["tmp_name"], $anh);
    } else {
        $anh = $_POST['current_image'];
    }

    $update = $data->update_news($id, $tieude, $noidungngan, $noidungdu, $tacgia, $ngay, $anh, $category_id);
    if ($update) {
        echo "<script>
                alert('Bài viết đã được cập nhật!');
                window.location.href = '/WebPHP/tintuc14022025/admin/post_select.php';
              </script>";
    } else {
        echo "<script>alert('Bài viết chưa được cập nhật');</script>";
    }
}

// XỬ LÝ XÓA BÀI VIẾT
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $delete = $data->delete_news($id);
    if ($delete) {
        echo "<script>
                alert('Bài viết đã được xóa!');
                window.location.href = '/WebPHP/tintuc14022025/admin/post_select.php';
              </script>";
    } else {
        echo "<script>alert('Bài viết chưa được xóa');</script>";
    }
}

// XỬ LÝ DANH MỤC
// Thêm danh mục
if (isset($_POST['btn_add_category'])) {
    $name = $_POST['category_name'];
    $description = $_POST['category_description'];

    $add_category = $data->add_category($name, $description);

    if ($add_category) {
        echo "<script>
            alert('Danh mục đã được thêm mới!');
            window.location.href = '/WebPHP/tintuc14022025/admin/category_select.php';
        </script>";
    } else {
        echo "<script>alert('Lỗi khi thêm danh mục!');</script>";
    }
}

// Cập nhật danh mục
if (isset($_POST['btn_update_category'])) {
    $id = $_POST['category_id'];
    $name = $_POST['category_name'];
    $description = $_POST['category_description'];

    $update = $data->update_category($id, $name, $description);
    if ($update) {
        echo "<script>
            alert('Danh mục đã được cập nhật!');
            window.location.href = '/WebPHP/tintuc14022025/admin/category_select.php';
        </script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật danh mục!');</script>";
    }
}

// Xóa danh mục
if (isset($_GET['delete_category_id'])) {
    $id = $_GET['delete_category_id'];
    $delete = $data->delete_category($id);
    if ($delete) {
        echo "<script>
            alert('Danh mục đã được xóa!');
            window.location.href = '/WebPHP/tintuc14022025/admin/category_select.php';
        </script>";
    } else {
        echo "<script>alert('Lỗi khi xóa danh mục!');</script>";
    }
}

// API Lấy thông tin danh mục
if (isset($_GET['get_category_id'])) {
    $id = $_GET['get_category_id'];
    $category = $data->get_category_by_id($id);
    
    if ($category) {
        header('Content-Type: application/json');
        echo json_encode($category);
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Không tìm thấy danh mục']);
        exit();
    }
}
?>