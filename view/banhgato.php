<?php
 include("controller/addtocart3.php");
 $html_dssp_new3="";
 foreach($dssp_new3 as $item){
     extract($item);
     // Đảm bảo biến $gia đã được định nghĩa trước khi sử dụng
     if(isset($gia)) {
         $formatted_price = number_format($gia, 0, ',', '.')."đ";
         $html_dssp_new3.=' 
         <div class="card"> 
             <div class="product-img">
                 <img src="view/img/'.$image.'" class="card-img-top" alt="...">
             </div>
             <div class="card-body">
                 <h5 class="card-title">'.$tensanpham.'</h5>
                 <p class="card-text"><span class="sale-price">'.$formatted_price.'</span></p> 
             </div>
             <form method="post" action="">
             <input type="hidden" name="product_id" value="'.$id.'"> 
                 <input type="hidden" name="product_name" value="'.$tensanpham.'">
                 <input type="hidden" name="product_price" value="'.$gia.' ">
                 <input type="hidden" name="product_image" value="'.$image.'" >
                 <input  class="btn btn-pink addtocart"  type="submit" name="add_to_cart" value="Thêm vào giỏ hàng" >
             </form>
         </div>';
     }
 }
?>
<div class="trending-proudct">
        <div class="container">
            <h2 class="web-title">Bánh kem</h2>
            <!-- <ul class="nav nav-pills nav-pink mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="family-bread-tab" data-toggle="pill" data-target="#family-bread" type="button" role="tab" aria-controls="family-bread" aria-selected="true">Bánh gia đình</button>
                </li>   
                <li class="nav-item" role="presentation">
                    <button class="nav-linkf" id="gato-tab" data-toggle="pill" data-target="#gato" type="button" role="tab" aria-controls="gato" aria-selected="false">Bánh gato</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="bread-tab" data-toggle="pill" data-target="#bread" type="button" role="tab" aria-controls="bread" aria-selected="false">Bánh mỳ</button>
                </li>
            </ul> -->
            <div class="tab-content pt-4" id="pills-tabContent">
                <div class="tab-pane fade show active" id="family-bread" role="tabpanel" aria-labelledby="family-bread-tab">
                    <div class="row">
                    <?=$html_dssp_new3?>
                          </div>
                        </div>
                    </div>
                </div>
                    <div class="pagination">
                        <?php
                     echo phantrang3($tranghientai3,So_SPT);
                   ?>
            
                </div>
            </div>
   <style>
     .trending-proudct .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
       
        
    }
   .trending-proudct .pagination a {
        text-decoration: none;
        padding: 5px 20px;
        margin-right: 5px;
        border: 1px solid #ccc;
        background-color:#FE6A84;
    }
   .trending-proudct .pagination a:hover {
        background-color: #f0f0f0;
    }
    .trending-proudct .container .row .card .addtocart{
        color:#f0f0f0;
    }
   
    .close-btn {
        left:0;
        cursor: pointer;
    }
    .row .card .card-img-top{
        width:248px;
        height:248px;
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

   </style>
