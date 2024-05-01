<?php
header('Content-Type: application/json');

// Establish database connection
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

// Create database connection
$conn = connectDB();

// Check connection
if (!$conn) {
    die("Connection failed: Could not connect to the database.");
}
$selectedMonth = (int)$_POST['month'];
// SQL query to get total bills per day in the current month
$sqlQuery = "SELECT DAY(date) AS day, SUM(totalbill) AS totalbill2 FROM dbl_customer WHERE MONTH(date) = ? AND YEAR(date) = YEAR(CURRENT_DATE()) GROUP BY DAY(date)";


try {
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute([$selectedMonth]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
} catch(PDOException $e) {
    echo json_encode(array('error' => 'Query failed:'.$e->getMessage()));
}

// Close database connection
$conn = null;
?>
