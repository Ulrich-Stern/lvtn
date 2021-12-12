<?php
require_once('connect_to_server.php');
function get_products($cate_id)
{
    global $db;
    $sql_cmd = "SELECT * from products where product_category = '$cate_id'";
    $sql = mysqli_query($db, $sql_cmd);

    $row = mysqli_num_rows($sql);
    if ($row)
        return mysqli_fetch_all($sql, MYSQLI_ASSOC);
    return 0;
}
function get_categories()
{
    global $db;
    $sql_cmd = "SELECT * from category";
    $sql = mysqli_query($db, $sql_cmd);
    return mysqli_fetch_all($sql, MYSQLI_ASSOC);
}
function get_category_name($id)
{
    global $db;
    $sql_cmd = "SELECT cate_title from category where cate_id = '$id'";
    $sql = mysqli_query($db, $sql_cmd);
    return mysqli_fetch_array($sql, MYSQLI_ASSOC);
}
function get_product_detail($id)
{
    global $db;
    $sql_cmd = "SELECT * from products where product_id = '$id'";
    $sql = mysqli_query($db, $sql_cmd);
    return mysqli_fetch_array($sql, MYSQLI_ASSOC);
}
function get_comment($product_id)
{
    global $db;
    $sql_cmd = "SELECT name, avatar, review, comment from rating r, user_profile p  where r.product_id = '$product_id' and p.username = r.username";
    $sql = mysqli_query($db, $sql_cmd);
    return mysqli_fetch_all($sql, MYSQLI_ASSOC);
}
function get_user_name_avatar($usr)
{
    global $db;
    $sql_cmd = "SELECT name, avatar from user_profile where username = '$usr'";
    $sql = mysqli_query($db, $sql_cmd);
    return mysqli_fetch_array($sql, MYSQLI_ASSOC);
}

function add_new_comment($usr, $product_id, $review, $cmt)
{
    global $db;
    $sql_cmd = "INSERT into rating (username, product_id, review, comment) values ('$usr', '$product_id', '$review', '$cmt')";
    $sql = mysqli_query($db, $sql_cmd);
    return 0;
}
function isSubSequence(
    $str1,
    $str2,
    $m,
    $n
) {
    // Base Cases
    if ($m == 0) return true;
    if ($n == 0) return false;

    // If last characters of two
    // strings are matching
    if ($str1[$m - 1] == $str2[$n - 1])
        return isSubSequence(
            $str1,
            $str2,
            $m - 1,
            $n - 1
        );

    // If last characters
    // are not matching
    return isSubSequence(
        $str1,
        $str2,
        $m,
        $n - 1
    );
}

function search_filter($product)
{
    $keyword = strtolower($_SESSION['search_keyword']);
    $title = strtolower($product['product_title']);

    return isSubSequence($keyword, $title, strlen($keyword), strlen($title));
}
function search_products()
{
    global $db;
    $sql_cmd = "SELECT * FROM products";
    $sql = mysqli_query($db, $sql_cmd);

    $list = mysqli_fetch_all($sql, MYSQLI_ASSOC);
    return array_filter($list, "search_filter");
}
