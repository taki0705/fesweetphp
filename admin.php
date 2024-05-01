<?php 
        include "model/connect.php";
        include "model/product.php";
        $category=select_sql("SELECT * from category");
        $postid=select_sql("SELECT * from postid");
        $show_product = select_sql("SELECT * FROM tbl_sanpham");
        $showallproduct = "";
        foreach ($show_product as $item) {  
        extract($item);
            $showallproduct .= '
                <tr class="showproduct1">
                    <td>'.$id.'</td>
                    <td> <img src="./view/img/'.$image.'" alt="" id="imagepr"></td>
                    <td>'.$tensanpham.'</td>
                    <td>'.$gia.'đ</td>
                    <td>'.$iddanhmuc.'</td>
                </tr>';
        }
        $show_order=select_sql("SELECT id,madon, date,fullname,status FROM dbl_customer 
        ");
        $showallorder = "";
        foreach ($show_order as $item) {  
        extract($item);
        $status_check=($status==0) ? "Chưa Thanh Toán" :"Đã Thanh Toán";
            $showallorder .= '
                <tr class="showproduct1">
                   <td>'.$id.'</td>   
                    <td>'.$madon.'</td>    
                    <td>'.date('d M y H:i:s', strtotime($date)).'</td>
                    <td>'.$fullname.'</td>
                    <td> <a href="inhoadon.php?id='.$id.'"> In Hóa đơn</a> 
                    <a href="xemchitiet.php?id='.$id.'">Xem chi tiết</a>
                    </td>
                     <td><button class="status" onclick="changeStatus('.$id.')">'.$status_check.'</button></td>
                </tr>';
        }
     
        if(isset($_POST['add'])) {
                 $id = $_POST['id'];
                $name = $_POST['tensanpham'];             
                $gia = $_POST['gia'];
                $danhmuc = $_POST["danhmuc"];
                if(isset($_FILES["image"])){
                    $file= $_FILES[ "image"];
                    $file_name= $file["name"];  
                    move_uploaded_file( $file['tmp_name'], 'view/img/'.$file_name );
                }
            $add="INSERT INTO tbl_sanpham(id,tensanpham,image,gia,iddanhmuc) VALUES (' $id','$name','$file_name','$gia','$danhmuc')";
            $query=select_sql($add);
            if(!$query){
                echo "Thêm thành công";
              
            } else {
                echo "Có lỗi khi thêm sản phẩm";
            }
            }
            if(isset($_POST['delete'])) {
                $id = $_POST['id'];
                $delete_query = "DELETE FROM tbl_sanpham WHERE id = '$id'";
                $query = select_sql($delete_query);
                if(!$query) {
                    echo"Xóa sản phẩm thành công";
               
                } else {
                    echo "Có lỗi khi xóa sản phẩm";
                }
            }
            if(isset($_POST['update'])) {
                // Lấy thông tin từ form
                $id = $_POST['id'];
                $name = $_POST['tensanpham'];
                $gia = $_POST['gia'];
                $danhmuc = $_POST["danhmuc"];
                
                // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
                $update_query = "UPDATE tbl_sanpham SET tensanpham = '$name', gia = '$gia', iddanhmuc = '$danhmuc' WHERE id = '$id'";
                $query = select_sql($update_query);
                
                // Kiểm tra kết quả của truy vấn và gán thông báo tương ứng
                if(!$query) {
                    echo "Cập nhật sản phẩm thành công";
                 
                } else {
                    echo "Có lỗi khi cập nhật sản phẩm";
                }
            }
            
            if(isset($_GET['search'])) {
                $keyword = $_GET['keyword']; // Get the keyword from the form submission
                // Modify your SQL query to search for the keyword in the product name or description
                $search_product = select_sql("SELECT * FROM tbl_sanpham WHERE tensanpham LIKE '%$keyword%'");
                $showallproduct = "";
                foreach ($search_product as $item) {  
                    extract($item);
                    $showallproduct .= '
                        <tr class="showproduct1">
                            <td>'.$id.'</td>
                            <td> <img src="./view/img/'.$image.'" alt="" id="imagepr"></td>
                            <td>'.$tensanpham.'</td>
                            <td>'.$gia.'đ</td>
                            <td>'.$iddanhmuc.'</td>
                        </tr>';
                }
            }


            if(isset($_POST['addpost'])) {
                $id = $_POST['id'];
                $tenbaiviet = $_POST['tenbaiviet'];             
                $danhmuc = $_POST["danhmucpost"];
                $content = $_POST["content"];
                if(isset($_FILES["imagepost"])){
                    $file= $_FILES[ "imagepost"];
                    $file_name= $file["name"];  
                    move_uploaded_file( $file['tmp_name'], 'view/img/'.$file_name );
                }
            $addpost="INSERT INTO post(id,namepost,image,content,idbaiviet) VALUES (' $id','$tenbaiviet','$file_name','$content','$danhmuc')";
            $query=select_sql($addpost);
            if(!$query){
                echo "Thêm thành công";
              
            } else {
                echo "Có lỗi khi thêm sản phẩm";
            }
        } 

        if(isset($_POST['deletepost'])) {
            $tenbaiviet = $_POST['tenbaiviet']; // Lấy tên bài viết cần xóa
        
            // Tạo truy vấn SQL để xóa bài viết có tên cụ thể
            $deleteQuery = "DELETE FROM post WHERE namepost = '$tenbaiviet'";
            $result = select_sql($deleteQuery);
        
            if($result) {
                echo "Xóa thành công bài viết có tên: $tenbaiviet";
            } else {
                echo "Có lỗi khi xóa bài viết";
            }
        }
        if(isset($_POST['updatepost'])) {
            $tenbaiviet = $_POST['tenbaiviet']; // Lấy tên bài viết cần cập nhật
            $newContent = $_POST['newcontent']; // Lấy nội dung mới cho bài viết
        
            // Tạo truy vấn SQL để cập nhật nội dung của bài viết có tên cụ thể
            $updateQuery = "UPDATE post SET content = '$newContent' WHERE namepost = '$tenbaiviet'";
            $result = select_sql($updateQuery);
        
            if($result) {
                echo "Cập nhật thành công bài viết có tên: $tenbaiviet";
            } else {
                echo "Có lỗi khi cập nhật bài viết";
            }
        }
        if(isset($_GET['searchbill'])) {
            $keyword = $_GET['keywordbill']; // Lấy từ khóa tìm kiếm từ yêu cầu AJAX
        
            // Thực hiện truy vấn SQL để tìm kiếm hóa đơn
            $search_bill = select_sql("SELECT * FROM dbl_customer WHERE madon LIKE '%$keyword%'");
        
            // Xây dựng HTML cho các hàng trong bảng kết quả tìm kiếm
            $showallorder = "";
            foreach ($search_bill as $item) {  
                extract($item);
                $status_check=($status==0) ? "Chưa Thanh Toán" :"Đã Thanh Toán";
                $showallorder .= '
                    <tr class="showproduct1">
                       <td>'.$id.'</td>   
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
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["orderId"])) {
    
            $orderId = $_POST["orderId"];
            $status = 1;
             $sql = "UPDATE dbl_customer SET status = $status WHERE id = $orderId";
             $result2 = select_sql($sql);
             echo 'Chuyển Thành Công';
        } else {
            echo 'Chuyển Thành Công';
        }
        
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container">
    <div class="menu">
            <div>
                <a href="#" onclick="toggleContent('product')">Sản phẩm</a> |
                <a href="#" onclick="toggleContent('post')">Đăng bài</a> |
                <a href="#" onclick="toggleContent('account')">Thống kê doanh thu</a> |
                <a href="#" onclick="toggleContent('statistics')">Thống kê</a>
            </div>
            <div>
                <a href="#" onclick="confirmLogout()" >Đăng xuất</a>
            </div>
        </div>
        <div class="container2">
            <div class="content" id="productContent">
            <form method="GET">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
             <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Search" name="search"></input >
             </form>
            <div style="display: flex;">
                <div class="congtentin">
                 <h1>Đăng Sản phẩm</h1> 
            <form class="container1" method="post" enctype="multipart/form-data">
            <label for="tensanpham">ID</label>
            <input type="text" id="id" name="id" >
        <label for="tensanpham">Tên Sản Phẩm:</label>
        <input type="text" id="tensanpham" name="tensanpham" >

        <label for="image">Hình Ảnh:</label>
        <input type="file" id="image" name="image" accept="image/*" >

        <label for="gia">Giá:</label>
        <input type="text" id="gia" name="gia" >

        <label for="danhmuc">Danh Mục:</label>
        <select id="danhmuc" name="danhmuc" >
        <?php foreach($category as $key => $value){ ?>
            <option value="<?php echo $value['id']?>">   <?php echo $value['namect'] ?> </option>
            <?php } ?>
        </select>
        <input type="submit" name="add" value="Thêm">
        <input type="submit" name="update" value="Sửa">
        <input type="submit" name="delete" value="Xóa">
        </form>
        
         </div>
            <table class="showproduct">
                    <thead>
                        <tr  class="showproduct1">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Danh mục</th>
                        </tr>
                    </thead>
                    <tbody class="scroll" >       
                    <?=$showallproduct?>     
                
                
                <!-- Add more rows here if needed -->
            </tbody>
        </table> 

            </div>

        </div>
        
        <div class="content hidden" id="postContent">
            <!-- Content for posting new articles will go here -->
            <h1>Đăng bài</h1>
                    <form class="" method="post" enctype="multipart/form-data">
                <label for="tenbaiviet">Tên Bài Viết</label>
                <input type="text" id="tenbaiviet" name="tenbaiviet" >

                <label for="imagepost">Hình Ảnh:</label>
                <input type="file" id="image" name="imagepost" accept="image/*" >

                <label for="content">Nôị dung</label>
                <input type="text" id="content" name="content" >

                <label for="danhmucpost">Danh Mục:</label>
                <select id="danhmuc" name="danhmucpost" >
                <?php foreach($postid as $key => $value){ ?>
                    <option value="<?php echo $value['id']?>">  <?php echo $value['namecontent'] ?> </option>
                    <?php } ?>
                </select>
                <input type="submit" name="addpost" value="Thêm">
                <input type="submit" name="updatepost" value="Sửa">
                <input type="submit" name="deletepost" value="Xóa">
                </form>

        </div>
        <div class="content hidden" id="accountContent">
            <h1 class="tkdoanhthu">Thống kê Doanh Thu Tháng</h1>
                    <div class="chart-container">
                <canvas id="graphCanvas"></canvas>
            </div>
            <h1 class="tkdoanhthu">Thống kê Doanh Thu Ngày</h1>
            <form id="monthForm">
                        <select id="monthSelector" onchange="showGraph2()">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
            </select>
            </form>
            <div class="chart-container">
                <canvas id="graphCanvasDaily"></canvas>
            </div>

        </div>
        <div class="content hidden" id="statisticsContent">
            <h1>Thống kê</h1>
            <form method="GET">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keywordbill">
             <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Search" name="searchbill"></input >
             </form>
            <table class="showproduct">
            <thead>
                        <tr  class="showproduct1">
                            <th>STT</th>
                            <th>Mã người đặt</th>
                            <th>Ngày Đặt</th>
                            <th>Tên người đặt</th>
                            <th>Action</th>
                            <th>Tình trạng</th>
                        </tr>
            </thead>
            <tbody class="scroll" id="showallorder">       
                    <?=$showallorder?>     
                
                <!-- Add more rows here if needed -->
            </tbody>
            </table> 
            
        </div>
    </div>
   
    </body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function toggleContent(contentId) {
            var contents = document.getElementsByClassName('content');
            for (var i = 0; i < contents.length; i++) {
                contents[i].classList.add('hidden');
            }
            document.getElementById(contentId + 'Content').classList.remove('hidden');
        }
    function confirmLogout() {
        // Sử dụng hộp thoại xác nhận để yêu cầu xác nhận từ người dùng
        var confirmation = confirm("Bạn có muốn đăng xuất không?");
        
        // Kiểm tra xem người dùng đã nhấn OK hay Cancel
        if (confirmation) {
            // Nếu người dùng nhấn OK, thực hiện hành động đăng xuất
            window.location.href = "index.php"
         
        } else {
            alert("Bạn vẫn đang đăng nhập.");
        }
     }


        $(document).ready(function () {
            showGraph();
            showGraph2()
        });

        function showGraph() {
            $.post("model/data.php", function (data) {
                var months = [];
                var totalBills = [];

                for (var i in data) {
                    months.push(data[i].month);
                    totalBills.push(data[i].totalbill);
                }

                var chartdata = {
                    labels: months,
                    datasets: [{
                        label: 'Tổng số tiền của hóa đơn các tháng',
                        backgroundColor: '#49e2ff',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: totalBills
                    }]
                };

                var graphTarget = $("#graphCanvas");

                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata
                });
            });
        }

  

        var barGraphDaily; // Define a variable to store the chart instance

function showGraph2() {
    var selectedMonth = $('#monthSelector').val(); // Get the selected month value
    $.post("model/datadaily.php", { month: selectedMonth }, function(data) {
        var daysInMonth = [];
        var totalBillsPerDay = [];

        for (var i in data) {
            daysInMonth.push(data[i].day);
            totalBillsPerDay.push(data[i].totalbill2);
        }

        var chartDataDaily = {
            labels: daysInMonth,
            datasets: [{
                label: 'Tổng tiền các ngày',
                backgroundColor: '#49e2ff',
                borderColor: '#46d5f1',
                hoverBackgroundColor: '#CCCCCC',
                hoverBorderColor: '#666666',
                data: totalBillsPerDay
            }]
        };

        var graphTargetDaily = $("#graphCanvasDaily");
        // Destroy the existing chart if it exists
        if (barGraphDaily) {
            barGraphDaily.destroy();
        }
        // Create a new chart
        barGraphDaily = new Chart(graphTargetDaily, {
            type: 'bar',
            data: chartDataDaily
        });
    });
}



        $(document).ready(function(){
    $('#searchbill').submit(function(e){
        e.preventDefault(); // Ngăn form được gửi đi một cách thông thường

        // Lấy từ khóa tìm kiếm từ ô input
        var keywordbill = $('input[name="keywordbill"]').val();

        // Gửi yêu cầu AJAX đến tệp tin PHP xử lý tìm kiếm
        $.ajax({
            type: 'GET',
            url: 'admin.php', // Đường dẫn tới tệp tin PHP xử lý tìm kiếm
            data: {keywordbill: keywordbill}, // Dữ liệu gửi đi là từ khóa tìm kiếm
            success: function(response){
                // Cập nhật nội dung của bảng hiển thị kết quả tìm kiếm
                $('#showallorder').html(response);
            }
        });
    });
});
function changeStatus(orderId) {
    if (confirm('Bạn có chắc chắn muốn thanh toán đơn hàng này không?')) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'admin.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var data = 'orderId=' + orderId;
        xhr.send(data);
     
    }
}
    </script>

    <style>
      body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .container .container2{
            display: flex;
            justify-content: space-between;
        }
        .congtentin{
            margin-top: 20px;
            width: 35%;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container .menu {
            display: flex;
            justify-content: space-between;
            background-color: #FE6A84;
            color: #fff;
            padding: 10px 20px;
        }
        .menu a {
            color: #fff;
            text-decoration: none;
        }
        .menu a:hover {
            text-decoration: underline;
        }
        .hidden {
            display: none;
        }
        #imagepr{
            width: 100px;
            height: 100px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #FE6A84; /* Màu hồng */
            color: white; /* Màu chữ trắng */   
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width:90px;
            height:80px;
        }

        input[type="submit"]:hover {
            background-color: #593E67;
        }
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
        .chart-container {
            width: 100%;
            height: 600px;
        }
        .tkdoanhthu{
            width:1000px;
        }
    </style>
     <link rel="stylesheet" href="./view/libs/bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <!-- Slick -->
    <link rel="stylesheet" href="./view/libs/slick/slick.css">
    <!-- Slick Theme -->
    <link rel="stylesheet" href="./view/libs/slick/slick-theme.css">
    <!-- My Css -->
    <link rel="stylesheet" href="./view/dist/css/style.css" >
    