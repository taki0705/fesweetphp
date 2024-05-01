<?php
// Lấy giá trị từ URL
if(isset($_GET['orderid']) && isset($_GET['totalprice'])) {
    $orderid = $_GET['orderid'];
    $totalprice = $_GET['totalprice'];
}
?>
<div class="container2">
    <div class="border">
    <div class="head">
       
        <div class="thank">Cảm ơn bạn đã mua hàng tại</div>
        <div class="hightlight">Sweet cake</div>  
        <div>Mã đơn hàng của bạn là:<?php echo $orderid; ?></div>    
</div>
   <div class="content"> 
    <div class="zalo">
        <div class="thank">Thanh Toán Online Qua</div>
         <label>Vui lòng thanh toán theo mã QH hoặc thông tin dưới đây </label>
        <div>   Sau đó gửi lại ảnh giao dịch qua Zalo này giúp Sweet Dreams nha!</div>
        <div class="imagezalo">
             <div>Nhắn ngay!</div>
               <a> <img src="view/img/7044033_zalo_icon.png"></a>
        </div>
   </div>
<div class="incontent">
   <div class="account">
    <div>
        <label>Ngân hàng:</label>  <label class="hightlight">MB</label>
    </div>
    <div>
        <label>Số Tài Khoản:</label> <label class="hightlight">0969053040</label>
 
    </div>
    <div>
        <label>Chủ tài khoản:</label> <label class="hightlight">BUI HUY HUNG</label>
   
    </div>
    <div>
        <label>Tổng tiền thanh toán:</label> <label class="hightlight"> <label class="hightlight"><?php echo $totalprice; ?></label></label>

    </div>
 
    <div>
    <label>Ghi chú:</label>
        <label class="hightlight"><?php echo $orderid; ?></label>
</div>
</div>

   <div>
     <img src="view/img/bank.png" class="imgbank">
   </div>
   </div>

</div>
</div>
</div>

<style>
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



