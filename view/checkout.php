    <?php 
    
        $dssp_cart2=select_sql("SELECT * FROM cart");
        $html_cart_new2="";
        $totalPrice=0;
        foreach ($dssp_cart2 as $item) {
            extract($item);
            $quantiy = 1; // Định nghĩa $quantity (chắc chắn không phải $quantiy)
            $itemTotalPrice = $quantity * $price;
            $itemTotalPriceFormatted = number_format($itemTotalPrice, 0, ',', '.');
            $totalPrice += $itemTotalPrice;
            if(isset($price)) {
                $formatted_price = number_format($price, 0, ',', '.')."đ";
            $html_cart_new2 .= '
                <div class="card2">
                    <img src="view/img/'.$image.'" class="imgcheckout">
                    <div class="info">
                        <div class="name">'.$name.'</div>
                        <div class="price">'.$formatted_price.'</div>
                    </div>
                    <div class="quantity">'.$quantity.'</div>
                    <div class="returnPrice">'.$itemTotalPriceFormatted.'đ</div> 
                </div>';
        }
        }
        $totalPriceFormatted = number_format($totalPrice, 0, ',', '.');

      if(isset($_POST['checkout'])) {

        $cart = select_sql("SELECT * FROM cart");
        if($cart) {
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $char1 = chr(rand(65,90));
            $char2 = chr(rand(65,90));
            $number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $orderid = $char1. $char2  . $number;
            $addCustomerQuery = "INSERT INTO dbl_customer (fullname, email,phone, address,totalbill,date,madon) VALUES ('$fullname','$email' ,'$phone', '$address','$totalPrice', NOW(),'$orderid')";
            $customerId = insert_sql2($addCustomerQuery);
            foreach ($cart as $item) {
                $productId = $item['idproduct'];
                $nameproduct = $item['name'];
                $quantity = $item['quantity'];
                $price = $item['price'];
                $image = $item['image'];
                $totalprice=$quantity*$price;

                // Thêm đơn hàng vào bảng `tbl_order`
                $addOrderQuery = "INSERT INTO tbl_order (idcustomer, nameproduct, idproduct, quantity, price,totalprice, image) VALUES ('$customerId', '$nameproduct', '$productId', '$quantity', '$price','$totalprice', '$image')";
                $orderResult = insert_sql($addOrderQuery);
            }
            $deleteCartQuery = "DELETE FROM cart";  
            $deleteCartResult = insert_sql($deleteCartQuery);
            $url = 'index.php?page=bank&orderid=' . $orderid . '&totalprice=' . $totalPrice;
            echo '<script>window.location.href = "' . $url . '";</script>';
            if(!$deleteCartResult) {
                $alert[]= "Bạn đã thanh toán thành công ";
                  // Output JavaScript code to redirect the user
             
           
                exit(); // Đảm bảo không có mã PHP tiếp theo được thực thi sau hàm header()
            }        
        } else {
            $alert[]= "Không có gì trong giỏ hàng";
        }
    }
        if (!empty($alert)) {
            foreach ($alert as $message) {
                echo "<div id='alert'>";
                echo "<span>$message</span>";
                echo "<span class='close-btn' onclick=\"this.parentElement.style.display='none';\">x</span>";
                echo "</div>";
            }
            echo '</div>';
        }
    
        
        
    ?>
    <link rel="stylesheet" href="./view/dist/css/style.css" >
    <div class="container">
                <div class="checkoutLayout">
            
                    <div class="returnCart">
                        <h1>List Product in Cart</h1>
                        <div class="list">
            
                    <?=$html_cart_new2?>
            
                        </div>
                    </div>
            
            
                    <div class="right">
                        <h1>Checkout</h1>
                        <form method="post" action="" onsubmit="return confirmCheckout()">
                        <div class="form">
                            <div class="group">
                                <label for="name">Tên</label>
                                <input type="text" name="fullname" id="fullname" required>
                            </div>
                            <div class="group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                            <div class="group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" name="address" id="address" required>
                            </div>
                            <div class="group">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" name="phone" id="phone" required>
                            </div>
                            <div class="group">
                                <label for="voucher">Voucher</label>
                                <input type="text" name="voucher" id="voucher1" >
                                <input type="submit" name="submit"id="voucher" value="Áp dụng"></input>
                            </div>

                        
                            <?php 
                            if(isset($_POST['submit'])) {
                                $voucherCode = $_POST['voucher']; // Assuming the input field name is  'voucher'
                                
                                // Fetch voucher details from the database based on the entered code
                                $voucherQuery = "SELECT * FROM voucher WHERE codevoucher = '$voucherCode'";
                                $voucherResult = select_sql($voucherQuery);
                            
                                if($voucherResult && $voucher = $voucherResult[0]) {
                                    $discount = $voucher['discount'];
                                    $discountedPrice = $totalPrice * (1 - $discount);
                                    $totalPriceFormatted = number_format($discountedPrice, 0, ',', '.');
                                    echo  " Đã Áp Dụng Voucher $voucherCode " ;
                                } else {
                                    // If voucher not found or invalid, show an error message
                                    echo  "Voucher không hợp lệ";
                                }
                            }
                            ?>
                
                        </div>
                        <div class="return">
                            <div class="row">
                                <div>Total Price</div>
                        <div class="totalPrice"><?php echo $totalPriceFormatted; ?>đ</div>';
                            </div>
                        </div>
                  
                            <input type="submit" class="buttonCheckout" name="checkout" value="CHECKOUT">
                  

                        <input type="hidden" name="totalPriceFormatted" value="<?php echo $itemTotalPriceFormatted; ?>">
                        </form>
                        </div>
                </div>
            </div>
            <style>
        .checkoutLayout{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 50px;
        padding: 30px;
    }

    .group input{
        color:black;
    }
    .checkoutLayout .right{
        background-color: #FE6A84;
        border-radius: 20px;
        padding: 40px;
        color: #fff;
        margin-left: 20px;
    }
    .checkoutLayout .right .form{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        border-bottom: 1px solid #e17f91;
        padding-bottom: 20px;
    }
    .checkoutLayout .form h1,
    .checkoutLayout .form .group:nth-child(-n+3){
        grid-column-start: 1;
        grid-column-end: 3;
    }
    .checkoutLayout .form input, 
    .checkoutLayout .form select
    {
        width: 100%;
        padding: 10px 20px;
        box-sizing: border-box;
        border-radius: 20px;
        margin-top: 10px;
        border:none;
        background-color: #eedfe2;
        color: black;
    }
    .checkoutLayout .right .return .row{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }
    .checkoutLayout .right .return .row div:nth-child(2){
        font-weight: bold;
        font-size: x-large;
    }
    .buttonCheckout{
        width: 100%;
        height: 40px;
        border: none;
        border-radius: 20px;
        background-color: #49D8B9;
        margin-top: 20px;
        font-weight: bold;
        color: #fff;
    }
    .returnCart h1{
        border-top: 1px solid #eee;  
        padding: 20px 0;
    }
    .returnCart .list .card2 img{
        height: 80px;
        border-radius: 10%;
    }
    .returnCart .list .card2{
        display: grid;
        grid-template-columns: 80px 1fr  50px 80px;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding: 0 5px;
        box-shadow: 0 10px 20px #5555;
        border-radius: 20px;
    }
    .returnCart .list .card2 .name,
    .returnCart .list .card2 .returnPrice{
        font-size: large;
        font-weight: bold;
    }
    .imgcheckout{
        width: 80px;
        height:80px;
    }
    #alert {
            background-color: #ffcccc; /* Màu hồng */
            width: 100%;
            padding: 10px; /* Thêm padding để tạo khoảng cách xung quanh nội dung */
            position: fixed; /* Đặt vị trí cố định */
            top: 0; /* Đặt ở phía dưới cùng */
            left: 0; /* Đặt ở phía trái cùng */
            z-index: 1000; /* Đặt z-index để đảm bảo nó hiển thị trên các phần tử khác */
            display: flex; /* Sử dụng flexbox để căn giữa nội dung */
            justify-content: space-between; 
            align-items: center; 
        }

        .close-btn {
            left:0;
            cursor: pointer;
        }
        .row .card .card-img-top{
            width:248px;
            height:248px;
        }
        #voucher{
            border-radius:20%;
            margin-top:20px;
            background-color: #EA4C89;
            cursor: pointer;
            font-family: "Haas Grot Text R Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            font-weight: 500;
            height: 40px;
            border:none;
            padding: 10px 16px;
            text-decoration: none;
            transition: color 100ms;
            vertical-align: baseline;
            user-select: none;
            touch-action: manipulation;
        }
        #voucher:hover,
        #voucher:focus {
            background-color: #F082AC;
        }
            .container2{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

    }
        .border{
        border:3px solid #FE6A84;
        border-radius:5%;
        width:60%;
        font-family:Comic Sans, Comic Sans MS, cursive;
    }
        .thank{
        font-size: 30px;
        color: black;
        font-weight: 600;
        font-style: italic
    }
        .head {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding:30px;
        }
        #sweet{
        color:#FE6A84;
        }       
        .incontent{
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: space-between;
        align-items: center;
        }
        .imgbank{
            width:200px;
        }
        .content .zalo{
        display:flex;
        flex-direction: column;
        width: 100%; 
        padding:20;
        justify-content: center;
        align-items: center;
        
        }
        .imagezalo{
        display:flex;
        flex-direction: row;
        width: 100%;
        justify-content: center;
        align-items: center;
        padding:5px;
        }
        .hightlight{
        color: #FE6A84;
        font-weight: 600;
        font-style: italic;
        font-size:20px;

        }
        .account{
            padding:100px
        }    
    </style>
    <script src="./view/dist/js/jquery-3.6.4.min.js"></script>
    <script src="./view/libs/slick/slick.min.js"></script>
    <script src="./view/dist/js/script.js"></script>

    <script>
   function confirmCheckout() {
    // Ask for confirmation
    var confirmed = confirm("Are you sure you want to proceed with the checkout?");
        

}

</script>



