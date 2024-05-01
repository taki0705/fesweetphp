<?php 
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "fesweet1";

$showallorder2 = ""; // Initialize $showallorder2 outside the if block

function connectDB2(){
    global $servername, $database, $username, $password;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        return null;
    }
    return $conn;
}

function select_sql3($sql){
    $conn = connectDB2();
    if ($conn == null) {
        // Handle connection error
        return null;
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn=null;
    return $result;   
}
if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword']; 
    // Use prepared statements to prevent SQL injection
    $search_results = select_sql3("SELECT * FROM dbl_customer WHERE madon LIKE '%$keyword%'");

    foreach ($search_results as $item) {  
        extract($item);
        $status_check=($status==0) ? "Chưa Thanh Toán" :"Đã Thanh Toán";
        $showallorder2 .= '
            <tr class="showproduct1">
                <td>'.$madon.'</td>    
                <td>'.date('d M y H:i:s', strtotime($date)).'</td>
                <td>'.$fullname.'</td>
                <td> <a href="inhoadon.php?id='.$id.'"> In Hóa đơn</a> 
                <a href="xemchitiet.php?id='.$id.'">Xem chi tiết</a>
                </td>
                <td><button class="status" onclick="changeStatus('.$id.')">'.$status_check.'</button></td>
            </tr>';
    }
}
?>  
<div class="container">
    <div class="container2">
        <form id="searchForm" method="GET">
            <input type="text" name="keyword" placeholder="Mã Đơn...">
            <input type="submit" class="btnsearch" value="Search">
        </form>
    </div>
    <table class="showproduct">
        <thead> 
            <tr> 
                <th>STT</th>
                <th>Mã người đặt</th>
                <th>Ngày Đặt</th>
                <th>Tên người đặt</th>
                <th>Action</th>
                <th>Tình trạng</th>
            </tr>
        </thead>
        <tbody class="search-results"  id="showallorder2">       
            <?= $showallorder2 ?>
        </tbody>
    </table> 
</div>


<style>
     
          .showproduct {
            margin-top:20px;
            margin-left:10px;
            width: 100%;
            border-collapse: collapse;
        }

        .showproduct th, .showproduct td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .showproduct th {
            background-color: #f2f2f2;
        }

        .showproduct tbody {
            display: block;
            max-height: 500px;
            overflow-y: auto;
            max-width: 100%;
        }

        .showproduct tr {
            display: table;
            width: 98%;
            table-layout: fixed;
        }

        .showproduct img {
            max-width: 100%;
            height: auto;
        }
        .btnsearch{
            background-color: #FE6A84;
            color: #fff;
            padding: 10px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
        }
</style>
    <script src="./view/dist/js/jquery-3.6.4.min.js"></script>
    <script src="./view/libs/slick/slick.min.js"></script>
    <script src="./view/dist/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.btnsearch').click(function(e){
        e.preventDefault();
        var keyword = $('input[name="keyword"]').val();
        $.ajax({
            type: 'GET',
            url: 'view/tracuu.php',
            data: {keyword: keyword},
            success: function(response){
                $('.container2').html(response);
            }
        });
    });
});
</script>