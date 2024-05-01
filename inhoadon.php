<?php 
    include "model/connect.php";
    include "model/product.php";
    if(isset($_GET['id'])) {
        $id = $_GET['id'];    
    }
    $customer = select_sql("SELECT * FROM dbl_customer WHERE id='$id'");
    $html_customer = "";
    foreach ($customer as $item) {
        extract($item);
        $html_customer .= '
        <p><strong>Fullname:</strong> ' . $fullname . '</p>
        <p><strong>Email:</strong> ' . $email . '</p>
        <p><strong>Phone:</strong> ' . $phone . '</p>
        <p><strong>Address:</strong> ' . $address . '</p>';
    }

// Lấy thông tin đơn hàng
$dssp_order = select_sql("SELECT * FROM tbl_order WHERE idcustomer='$id'");
$html_order = "";
foreach ($dssp_order as $item) {
    extract($item);
    $itemTotalPriceFormatted = number_format($totalprice, 0, ',', '.');
    $formatted_price = number_format($price, 0, ',', '.') . "đ";
    $html_order .= '
    <tr class="showproduct1">
        <td>' . $nameproduct . '</td>
        <td>' . $formatted_price . '</td>
        <td>' . $quantity . '</td>
        <td>' . $itemTotalPriceFormatted . 'đ</td>
    </tr>';
}

// Lấy thông tin totalprice và date
$total_price = 0;
foreach ($dssp_order as $item) {
    $total_price += $item['totalprice'];
}
$date = date("Y-m-d:i:s");

// Hiển thị phiếu thanh toán
?>
<div class="container">
    <h1>SWEET DREAMS</h1>
    <div>Số 9 Kim Mã, Ba Đình, Hà Nội</div>
    <div>ĐT:0969053040 - 0123456JQK</div>
    <h1>Phiếu thanh toán</h1>
    <div class="customer">
        <?= $html_customer ?>
    </div>
    <div>
        <table class="showproduct">
            <thead>
                <tr class="showproduct1">
                    <th>Tên sản phẩm</th>
                    <th>ĐG</th>
                    <th>SL </th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody class="scroll">
                <?= $html_order ?>
            </tbody>
        </table>
    </div>
    <p><strong>Tổng tiền:</strong> <?= number_format($total_price, 0, ',', '.') ?>đ</p>
    <p><strong>Ngày:</strong> <?= $date ?></p>
    <p>Cảm ơn quý khách hẹn gặp lại!!!!</p>
</div>

<style>
    
    .container{
        border: 2px solid #000000;
    padding: 10px;
    margin-top: 20px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
    width: 350px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    }
    .showproduct {
        margin-top:20px;
        margin-left:auto;
        margin-right:auto;
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
    .customer{
        
    }
</style>
