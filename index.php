<?php
define('So_SPT', 8);
include "model/connect.php";
include "model/product.php";
include "view/header.php";

// Danh sách các trang có thể xuất hiện
$allowedPages = ['sanpham', 'banhkem', 'banhmi','checkout','baiviet','banhgato','bank','tracuu'];

// Kiểm tra xem trang yêu cầu có trong danh sách được phép không
$page = isset($_GET['page']) ? $_GET['page'] : 'sanpham';
if (!in_array($page, $allowedPages)) {
   
    $page = 'sanpham';
}

// Xử lý cho từng trang
switch ($page) {
    case 'sanpham':
        // Xử lý cho trang sản phẩm
        if (isset($_GET['trang']) && ($_GET['trang'] > 0)) {
            $tranghientai = $_GET['trang'];
        } else {
            $tranghientai = 1;
        }
        $dssp_new = selectAll_Product($tranghientai);
        include 'view/sanpham.php';
        include "view/home.php";
        break;
    case 'banhkem':
        
        if (isset($_GET['trang']) && ($_GET['trang'] > 0)) {
            $tranghientai1 = $_GET['trang'];
        } else {
            $tranghientai1 = 1;
        }
        $dssp_new1 = selectAll_Product1($tranghientai1);

        include 'view/banhkem.php';
        include "view/home.php";
        break;
    case 'banhmi':
        // Xử lý cho trang bánh mỳ
        // ...
        if (isset($_GET['trang']) && ($_GET['trang'] > 0)) {
            $tranghientai2 = $_GET['trang'];
        } else {
            $tranghientai2 = 1;
        }
        $dssp_new2 = selectAll_Product2($tranghientai2);
        include 'view/banhmi.php';
        include "view/home.php";
    
     case 'banhgato':
        
            if (isset($_GET['trang']) && ($_GET['trang'] > 0)) {
                $tranghientai3 = $_GET['trang'];
            } else {
                $tranghientai3 = 1;
            }
            $dssp_new3 = selectAll_Product3($tranghientai3);
            include 'view/banhgato.php';
            include "view/home.php";
            break;          
    case 'checkout':
           // ...
            include 'view/checkout.php';
            break;
    case 'bank':
            include 'view/bank.php';
            break;
    case 'admin':
        echo "Chào mừng admin của tôi!";
        include 'admin.php';
        include "view/home.php";
        break;
    case 'baiviet':
        include 'view/baiviet.php';
        break;
    case 'tracuu':
        include 'view/tracuu.php';
        break;
    default:
        // Xử lý cho các trang khác nếu cần
        include "view/$page.php";
        break;
}
include "view/footer.php";
?>
  