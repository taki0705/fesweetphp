<?php
header('Content-Type: application/json');

// Thực hiện kết nối cơ sở dữ liệu ở đây
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "fesweet1";

function connectDB(){
    global $servername, $database, $username, $password;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        return null;
    }
}

// Tạo kết nối đến cơ sở dữ liệu
$conn = connectDB();

// Kiểm tra kết nối
if (!$conn) {
    die("Connection failed: Could not connect to the database.");
}

// Truy vấn SQL để lấy tổng số hóa đơn theo từng tháng
$sqlQuery = "SELECT MONTH(date) AS month, SUM(totalbill) AS totalbill FROM dbl_customer GROUP BY MONTH(date)";


try {
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
} catch(PDOException $e) {
    echo json_encode(array('error' => 'Query failed:'.$e->getMessage()));
}

// Đóng kết nối cơ sở dữ liệu
$conn = null;
?>
