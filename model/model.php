<?php
include('connect.php');

class Content
{
    public function add_news($tieude, $noidungngan, $noidungdu, $tacgia, $ngay, $anh, $category_id = null)
    {
        global $conn;

        $sql = "INSERT INTO content (n_title, n_shortcontent, n_longcontent, n_author, n_date, n_picture, category_id)
                VALUES ('$tieude', '$noidungngan', '$noidungdu', '$tacgia', '$ngay', '$anh', " . ($category_id ? "'$category_id'" : "NULL") . ")";

        $run = mysqli_query($conn, $sql);
        return $run;
    }

    public function select_news()
    {
        global $conn;
        $sql = "SELECT c.*, cat.name as category_name 
                FROM content c 
                LEFT JOIN categories cat ON c.category_id = cat.id
                ORDER BY c.n_date DESC";
        $run = mysqli_query($conn, $sql);
        return $run;
    }

    public function update_news($id, $tieude, $noidungngan, $noidungdu, $tacgia, $ngay, $anh, $category_id = null)
    {
        global $conn;

        $sql = "UPDATE content SET 
                n_title = '$tieude', 
                n_shortcontent = '$noidungngan', 
                n_longcontent = '$noidungdu', 
                n_author = '$tacgia', 
                n_date = '$ngay', 
                n_picture = '$anh',
                category_id = " . ($category_id ? "'$category_id'" : "NULL") . "
                WHERE ID_content = '$id'";

        $run = mysqli_query($conn, $sql);
        return $run;
    }

    public function get_news_by_id($id)
    {
        global $conn;
        $sql = "SELECT c.*, cat.name as category_name 
                FROM content c 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                WHERE c.ID_content = '$id'";
        $run = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($run);
    }

    public function delete_news($id)
    {
        global $conn;
        $sql = "DELETE FROM content WHERE ID_content = '$id'";
        $run = mysqli_query($conn, $sql);
        return $run;
    }

    public function get_all_posts()
    {
        global $conn;
        $sql = "SELECT c.*, cat.name as category_name 
                FROM content c 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                ORDER BY c.n_date DESC";
        $run = mysqli_query($conn, $sql);
        $posts = [];
        while ($row = mysqli_fetch_assoc($run)) {
            $posts[] = $row;
        }
        return $posts;
    }

    public function get_posts_by_category($category_id)
    {
        global $conn;
        $sql = "SELECT c.*, cat.name as category_name 
                FROM content c 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                WHERE c.category_id = '$category_id'
                ORDER BY c.n_date DESC";
        $run = mysqli_query($conn, $sql);
        $posts = [];
        while ($row = mysqli_fetch_assoc($run)) {
            $posts[] = $row;
        }
        return $posts;
    }

    public function add_category($name, $description)
    {
        global $conn;
        $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
        return mysqli_query($conn, $sql);
    }

    public function get_all_categories()
    {
        global $conn;
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        return mysqli_query($conn, $sql);
    }
    
    public function get_category_by_id($id)
    {
        global $conn;
        $sql = "SELECT * FROM categories WHERE id = '$id'";
        $run = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($run);
    }
    
    public function delete_category($id)
    {
        global $conn;
        $sql = "DELETE FROM categories WHERE id = '$id'";
        $run = mysqli_query($conn, $sql);
        return $run;
    }
    
    public function update_category($id, $name, $description)
    {
        global $conn;
        $sql = "UPDATE categories SET name = '$name', description = '$description' WHERE id = '$id'";
        $run = mysqli_query($conn, $sql);
        return $run;
    }
}
?>