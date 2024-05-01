<?php
// Kết nối đến cơ sở dữ liệu MySQL
$conn = mysqli_connect("localhost", "root", "", "fesweet1");

// Hàm kiểm tra thông tin đăng nhập
function check_user($username, $password) {
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT COUNT(*) AS count FROM admin WHERE user= '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        error_log("MySQL error: " . mysqli_error($conn));
        return -1;
    }

    $row = mysqli_fetch_assoc($result);
    if ($row['count'] == 0) {
        
        error_log("Tài khoản hay mật khẩu không đúng");
        return 0;
    }
    return $row['count'];
}
?>
