<?php 
    include "model/connect.php";
    include "model/product.php";
    if(isset($_GET['id'])) {
        $id = $_GET['id'];    
    }
    $dssp_order=select_sql("SELECT * FROM tbl_order where idcustomer='$id'");
    $html_order="";
    
     foreach ($dssp_order as $item) {
        extract($item);
        $itemTotalPriceFormatted = number_format($totalprice, 0, ',', '.');
        $formatted_price = number_format($price, 0, ',', '.')."đ";
        $html_order .= '
        <tr class="showproduct1">
        <td> <img src="./view/img/'.$image.'" alt="" id="imagepr"></td>
        <td>'.$nameproduct.'</td>
        <td>'.$formatted_price.'</td>
        <td>'.$quantity.'</td>
        <td>'.$itemTotalPriceFormatted.'đ</td>
    </tr>';    
     }
     $customer=select_sql("SELECT * FROM dbl_customer where id='$id'");
     $html_customer="";
     foreach ($customer as $item) {
        extract($item);
        $html_customer .= ' 
        <p><strong>Fullname:</strong> ' . $fullname . '</p>
        <p><strong>Email:</strong> ' . $email . '</p>
        <p><strong>Phone:</strong> ' . $phone . '</p>
        <p><strong>Address:</strong> ' . $address . '</p>';
     }
     ?>
<div class="container">
    <div class="customer">
        <h1>Thông tin người mua </h1> 
        <?= $html_customer ?>
    </div>
    </div> 
    <div>
        <h1>Thông tin đơn </h1>
     
      <table class="showproduct">
                    <thead>
                        <tr  class="showproduct1">
                            <th>Hình Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn Giá</th>
                            <th>Số lượng </th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody class="scroll" >       
                    <?= $html_order  ?>    
                
                
                <!-- Add more rows here if needed -->
            </tbody>
        </table> 
    </div>
    </div>
<style>
        .imgcheckout{
            width: 80px;
            border-radius: 20%;
            height:80px;
        }
        .showproduct {
                    margin-top:20px;
                    margin-left:10px;
                    width: 80%;
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
            width:100px;
            height: 100px;
        }
        .customer{
        
            border: 2px solid #000000;
            padding: 10px;
            margin-top: 20px;
            max-width: 400px;
        }
    </style>