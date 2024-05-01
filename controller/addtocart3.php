<?php 
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
                <form method="post" action="" class="add-to-cart-form">
                    <input type="hidden" name="product_id" value="'.$id.'"> 
                    <input type="hidden" name="product_name" value="'.$tensanpham.'">
                    <input type="hidden" name="product_price" value="'.$gia.' ">
                    <input type="hidden" name="product_image" value="'.$image.'" >
                    <input  class="btn btn-pink addtocart"  type="submit" name="add_to_cart" value="Thêm vào giỏ hàng">
                </form>
            </div>';
        }
    }
    $alert = array(); 
     if(isset($_POST['add_to_cart'])) {
        $product_id=$_POST['product_id'];
        $product_name=$_POST['product_name'];
        $product_price=$_POST['product_price'];
        $product_image=$_POST['product_image'];
        $product_quantity=1;
        $select_cart=("SELECT * FROM cart WHERE NAME='$product_name'");
        $result1 = select_sql($select_cart);
        if (count($result1) > 0) {
            $alert[]= "Bạn đã Thêm vào giỏ hàng thành công ";
        } else {
            $insert_cart = "INSERT INTO cart (idproduct,name, price, image, quantity) VALUES ('$product_id','$product_name', '$product_price', '$product_image', '$product_quantity')";
            $result1 = insert_sql($insert_cart);
            $alert[]= " Thêm vào giỏ hàng thành công ";
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