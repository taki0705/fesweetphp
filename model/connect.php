<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "fesweet1";
 function connectDB(){
    global $servername, $database, $username, $password;
   try {

    $conn = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
    $conn->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    return null;
}
return $conn;
}
// Check connection
function select_sql($sql){
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn=null;
    return $result;   
}
function insert_sql($sql) {
    $conn = connectDB();
try {         
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return true; // Insertion successful
    } catch(PDOException $e) {
return false; // Insertion failed
    }
}
function insert_sql2($sql) {
    $conn = connectDB();
    if (!$conn) {
        return false; // Không thể kết nối đến cơ sở dữ liệu
    }

    try {         
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lastInsertId = $conn->lastInsertId(); // Lấy ID của bản ghi mới được chèn
        return $lastInsertId; // Trả về ID của bản ghi mới được chèn
    } catch(PDOException $e) {
        return false; // Lỗi khi thực hiện truy vấn
    } finally {
        $conn = null; // Đóng kết nối
    }
}
function delete_sql($sql) {
    $conn = connectDB();
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return true; // Deletion successful
    } catch(PDOException $e) {
        return false; // Deletion failed
    }
}
function select_sql2($sql, $id){
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;   
}
?>
