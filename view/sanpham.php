<?php
     include("controller/addtocart.php");
?>
<div class="trending-proudct">
        <div class="container">
            <h2 class="web-title">Sản phẩm nổi bật</h2>
            <!-- <ul class="nav nav-pills nav-pink mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="family-bread-tab" data-toggle="pill" data-target="#family-bread" type="button" role="tab" aria-controls="family-bread" aria-selected="true">Bánh gia đình</button>
                </li>   
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="gato-tab" data-toggle="pill" data-target="#gato" type="button" role="tab" aria-controls="gato" aria-selected="false">Bánh gato</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="bread-tab" data-toggle="pill" data-target="#bread" type="button" role="tab" aria-controls="bread" aria-selected="false">Bánh mỳ</button>
                </li>
            </ul> -->
           
            <div class="tab-content pt-4" id="pills-tabContent">
                <div class="tab-pane fade show active" id="family-bread" role="tabpanel" aria-labelledby="family-bread-tab">
                    <div class="row">
                    <?=$html_dssp_new?>
                          </div>
                        </div>
                    </div>
                </div>
                    <div class="pagination">
                        <?php
                        $tranghientai = 1;
                     echo phantrang($tranghientai,So_SPT);
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















































