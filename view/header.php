<?php 
  include("model/user.php");
   $dssp_cart=select_sql("SELECT * FROM cart");
    $html_cart_new="";
    foreach($dssp_cart as $item){
        extract($item);
        if(isset($price)) {
         $formatted_price = number_format($price, 0, ',', '.')."đ";
          $html_cart_new.=' 
          <div id="incart-list"> 
          <img id="custom-image" src="view/img/'.$image.'" alt="">
          <div class="item-info">
              <h5 class="item-title">
                  <a href="">'.$name.'</a>
              </h5>
              <div id="quantity">
                  <form method="post" action="">
                      <input type="hidden" name="product_id" value="'.$id.'">
                      <input type="number" id="quantity_nb" name="quantity" value="1" min="1">
                      <button onclick="removeItem(' . $id . ')" id="btn_closex">x</button>
                  </form>
              </div>  
              <div id="price">
                  '.$formatted_price.'
              </div>
          </div>  
      </div>  
            ';
    }}
    function removeProductFromCart($product_id) {
        $conn = connectDB();
        if ($conn) {
            try {
                $stmt = $conn->prepare("DELETE FROM cart WHERE id = :product_id");
                $stmt->bindParam(':product_id', $product_id);
                $stmt->execute();
                return true; // Xóa thành công
            } catch(PDOException $e) {
                return false; // Xóa thất bại
            }
        } else {
            return false; // Không thể kết nối đến cơ sở dữ liệu
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
        $product_id = $_POST["product_id"];     
        if (removeProductFromCart($product_id)) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // Đảm bảo rằng dữ liệu đã được gửi dưới dạng JSON và chuyển đổi thành mảng
        $data = json_decode(file_get_contents("php://input"), true);
        
        // Kiểm tra xem dữ liệu có tồn tại và không rỗng
        if (!empty($data)) {
            foreach ($data as $item) {
              
                if (isset($item['product_id']) && isset($item['quantity'])) {
                    $product_id = $item['product_id'];
                    $quantity = $item['quantity'];
                    $updatecheckout = select_sql("UPDATE cart SET quantity=$quantity WHERE id=$product_id");
                }
            }
        }
        
    }

    if (isset($_POST['btnlogin'])) {
        $user = $_POST["username"];
        $password = $_POST["password"];
    
        // Query to check username and password in the database
        $user = check_user($user,$password);
        if ($user > 0) {
            // If credentials are correct, redirect to admin.php
            header("Location: admin.php");
            exit();
        } else {
            // If credentials are incorrect, display an error message
            echo "Thông tin đăng nhập không đúng.";
        }
    }
    

   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Dream</title>
    <!-- Logo -->
    <link rel="shortcut icon" href="./view/img/logo-circle.svg" type="image/x-icon">
    <link rel="icon" href="./view/img/logo-circle-2.svg" type="image/x-icon">
    <!-- Bootstrap 4.6 -->
    <link rel="stylesheet" href="./view/libs/bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <!-- Slick -->
    <link rel="stylesheet" href="./view/libs/slick/slick.css">
    <!-- Slick Theme -->
    <link rel="stylesheet" href="./view/libs/slick/slick-theme.css">
    <!-- My Css -->
    <link rel="stylesheet" href="./view/dist/css/style.css" >
</head>

<header class="header">
        <!-- Header Top -->
        <div class="header-top">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="header-top-left d-flex align-items-center">
                        <div class="header-info">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.208 11.1361C13.1709 10.3094 12.1184 9.80864 11.094 10.6341L10.4824 11.133C10.0348 11.4951 9.20274 13.1872 5.98562 9.73808C2.76917 6.29332 4.68323 5.75697 5.13143 5.39794L5.74645 4.89843C6.76545 4.07112 6.38089 3.02963 5.64595 1.95755L5.20244 1.30819C4.46415 0.238608 3.66021 -0.463831 2.63853 0.362237L2.08648 0.811798C1.63494 1.11837 0.372741 2.1149 0.0665717 4.00805C-0.301903 6.27958 0.860468 8.88079 3.52354 11.7349C6.18326 14.5902 8.78737 16.0244 11.2541 15.9995C13.3042 15.9789 14.5423 14.9536 14.9295 14.5809L15.4836 14.1307C16.5026 13.3052 15.8695 12.4648 14.8317 11.6362L14.208 11.1361Z" fill="#FE6A84"/>
                            </svg>     
                            <a href="tel:0969053040">0969053040</a>                           
                        </div>
                        <div class="header-info">
                            <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.33716 7.80279C8.93909 8.06817 8.47672 8.20845 8 8.20845C7.52331 8.20845 7.06094 8.06817 6.66287 7.80279L0.106531 3.43176C0.0701562 3.40751 0.0347187 3.38223 0 3.35623V10.5186C0 11.3398 0.666406 11.9915 1.47291 11.9915H14.5271C15.3482 11.9915 16 11.3251 16 10.5186V3.3562C15.9652 3.38226 15.9297 3.40761 15.8932 3.43189L9.33716 7.80279Z" fill="#FE6A84"/>
                                <path d="M0.626562 2.6518L7.18291 7.02286C7.43109 7.18833 7.71553 7.27105 7.99997 7.27105C8.28444 7.27105 8.56891 7.1883 8.81709 7.02286L15.3734 2.6518C15.7658 2.39039 16 1.95289 16 1.48071C16 0.668801 15.3395 0.00830078 14.5276 0.00830078H1.47241C0.660531 0.00833203 0 0.668832 0 1.48149C0 1.95289 0.23425 2.39039 0.626562 2.6518V2.6518Z" fill="#FE6A84"/>
                            </svg>
                            <a href="mailto:sweetdreams@gmail.com">sweetdreams@gmail.com</a>                      
                        </div>
                        <div class="header-info">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 16C12.4171 16 16 12.4171 16 8C16 3.58285 12.4171 0 8 0C3.58285 0 0 3.58285 0 8C0 12.4171 3.58285 16 8 16ZM7.42855 3.42858C7.42855 3.11428 7.6857 2.85713 8 2.85713C8.3143 2.85713 8.57144 3.11428 8.57144 3.42858V7.72572L11.2143 9.84001C11.46 10.0372 11.5 10.3971 11.3029 10.6429C11.1914 10.7829 11.0257 10.8571 10.8571 10.8571C10.7314 10.8571 10.6057 10.8171 10.5 10.7314L7.64288 8.44573C7.50859 8.33714 7.4286 8.1743 7.4286 8V3.42858H7.42855Z" fill="#FE6A84"/>
                            </svg>
                            <a href="#">6:00 - 22:00</a>                          
                        </div>
                    </div>
                    <div class="header-top-right d-flex">
                        <div class="order-now">
                            <button type="button" class="btn btn-pink orderNow" data-toggle="modal" data-target="#login">
                                Đăng nhập
                            </button>
                        </div>
                         <!-- 
                         <div class="order-now">
                            <button type="button" class="btn btn-pink orderNow" data-toggle="modal" data-target="#register">
                                Đăng Ký
                            </button>
                        </div>
                        <div class="order-now">
                            <button type="button" class="btn btn-pink orderNow" data-toggle="modal" data-target="#login">
                                Đăng Nhập
                            </button>
                        </div> -->
        
                        <!-- Cart Btn -->
                        <button class="navbar-toggler shopping-cart" type="button" cart-total="3" data-toggle="offcanvas" data-target="#cartOffcanvas">
                        <div id="cartadd">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.91868 6.22222V7.77778H4.55912C3.78426 7.77793 3.03759 8.03328 2.46644 8.49345C1.89528 8.95362 1.54112 9.58519 1.47382 10.2636L0.0117073 25.0413C-0.0255779 25.4171 0.0264263 25.7957 0.164421 26.1529C0.302415 26.5101 0.523387 26.8382 0.813319 27.1164C1.10325 27.3946 1.45581 27.6168 1.84863 27.7689C2.24146 27.921 2.66597 27.9997 3.09524 28H24.903C25.3324 27.9999 25.7571 27.9214 26.1501 27.7694C26.5432 27.6173 26.896 27.3952 27.1861 27.117C27.4762 26.8387 27.6973 26.5106 27.8354 26.1532C27.9735 25.7959 28.0256 25.4173 27.9883 25.0413L26.5262 10.2636C26.4589 9.58492 26.1044 8.95313 25.5329 8.49292C24.9614 8.03271 24.2143 7.77754 23.4391 7.77778H21.0796V6.22222C21.0796 4.57199 20.3336 2.98934 19.0057 1.82245C17.6779 0.655554 15.877 0 13.9991 0C12.1213 0 10.3203 0.655554 8.99249 1.82245C7.66465 2.98934 6.91868 4.57199 6.91868 6.22222V6.22222ZM13.9991 2.33333C12.8255 2.33333 11.6999 2.74305 10.87 3.47236C10.0401 4.20167 9.57384 5.19082 9.57384 6.22222V7.77778H18.4244V6.22222C18.4244 5.19082 17.9582 4.20167 17.1283 3.47236C16.2984 2.74305 15.1728 2.33333 13.9991 2.33333ZM9.57384 14C9.57384 15.0314 10.0401 16.0206 10.87 16.7499C11.6999 17.4792 12.8255 17.8889 13.9991 17.8889C15.1728 17.8889 16.2984 17.4792 17.1283 16.7499C17.9582 16.0206 18.4244 15.0314 18.4244 14V12.0556C18.4244 11.7461 18.5643 11.4494 18.8132 11.2306C19.0622 11.0118 19.3999 10.8889 19.752 10.8889C20.1041 10.8889 20.4417 11.0118 20.6907 11.2306C20.9397 11.4494 21.0796 11.7461 21.0796 12.0556V14C21.0796 15.6502 20.3336 17.2329 19.0057 18.3998C17.6779 19.5667 15.877 20.2222 13.9991 20.2222C12.1213 20.2222 10.3203 19.5667 8.99249 18.3998C7.66465 17.2329 6.91868 15.6502 6.91868 14V12.0556C6.91868 11.7461 7.05854 11.4494 7.30751 11.2306C7.55648 11.0118 7.89416 10.8889 8.24626 10.8889C8.59835 10.8889 8.93603 11.0118 9.185 11.2306C9.43397 11.4494 9.57384 11.7461 9.57384 12.0556V14Z" />
                            </svg>

                            <?php  
                                     $select_cart = select_sql("SELECT * FROM cart ");
                                     $row_count = count($select_cart);
                            ?>
                            <a class="totalQuantity"><?php echo $row_count; ?></a>  
                        </div>
                        </button>

                        <button class="navbar-toggler messenger" type="button" cart-total="3" data-toggle="" data-target="#">
                            <div id="cartadd">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    
                                    <path fill="#FE6A84" d="M1 17.99C1 8.51488 8.42339 1.5 18 1.5C27.5766 1.5 35 8.51488 35 17.99C35 27.4651 27.5766 34.48 18 34.48C16.2799 34.48 14.6296 34.2528 13.079 33.8264C12.7776 33.7435 12.4571 33.767 12.171 33.8933L8.79679 35.3828C7.91415 35.7724 6.91779 35.1446 6.88821 34.1803L6.79564 31.156C6.78425 30.7836 6.61663 30.4352 6.33893 30.1868C3.03116 27.2287 1 22.9461 1 17.99ZM12.7854 14.8897L7.79161 22.8124C7.31238 23.5727 8.24695 24.4295 8.96291 23.8862L14.327 19.8152C14.6899 19.5398 15.1913 19.5384 15.5557 19.8116L19.5276 22.7905C20.7193 23.6845 22.4204 23.3706 23.2148 22.1103L28.2085 14.1875C28.6877 13.4272 27.7531 12.5704 27.0371 13.1137L21.673 17.1847C21.3102 17.4601 20.8088 17.4616 20.4444 17.1882L16.4726 14.2094C15.2807 13.3155 13.5797 13.6293 12.7854 14.8897Z"></path>
                                </svg> 
                            </div>
                            </button>
                        
                        <!-- Offcanvas Cart -->
                        <div class="offcanvas" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel" >
                            <div class="offcanvas-header mb-5">
                                <h5 id="cartOffcanvasLabel">Giỏ hàng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 12.3108L2.83193 19.5117C2.18389 20.1628 1.13407 20.1628 0.486029 19.5117C-0.16201 18.8607 -0.16201 17.8061 0.486029 17.1551L7.61057 10.0008L0.487324 2.8449C-0.160715 2.1939 -0.160715 1.13926 0.487324 0.488256C1.13536 -0.162752 2.18519 -0.162752 2.83323 0.488256L10 7.68786L17.1668 0.488256C17.8148 -0.162752 18.8646 -0.162752 19.5127 0.488256C20.1607 1.13926 20.1607 2.1939 19.5127 2.8449L12.3894 10.0008L19.514 17.1551C20.162 17.8061 20.162 18.8607 19.514 19.5117C18.8659 20.1628 17.8161 20.1628 17.1681 19.5117L10 12.3108Z" />
                                        
                                    </svg>                                                         
                                </button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="cart-listt">
                                <?=$html_cart_new?>            
                                </div>
                                <div class="d-flex justify-content-between flex-wrap">
                                  
                                               
    <button type="submit" name="update_product"  class="btn btn-outline-pink flex-fill w-100 cart-btn" id="checkout" >Thanh Toán </button>
                                  
    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="login" tabindex="-1" aria-labelledby="orderNowLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title" id="orderNowLabel">Thông tin  Đăng nhập</h5>
            </div>
            <div class="modal-body">
               
            <form action="" method="post">
            <div class="register1">
                <div>Tên đăng nhập</div>
                <div class="col-md-8 col-padding-custom">
                    <input type="text" class="form-control inputusername" name="username">
                </div>
            </div>
            <div>Mật khẩu</div>
            <div class="register1">
                <div class="col-md-8 col-padding-custom">
                    <input type="password" class="form-control inputpassword" name="password">
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" name="btnlogin" class="btn btn-pink btnlogin">Đăng nhập</button>
            </div>
        </form>
                
                </div>

            </div>
           
        </div>
    </div>
</div>
        <!-- End Header Top -->
        <!-- Header Bottom -->
        <div class="header-bottom">
            <div class="container">
                <nav class="navbar navbar-expand-lg p-0 navbar-light nav-custom justify-content-between">
                    <a class="navbar-brand" href="#">
                        <img src="./view/img/logo-1.svg" alt="">
                    </a>
                    <button class="navbar-toggler" type="button"  aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" >
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Trang chủ <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sản phẩm
                            </a>
                                <ul id="category">
                                    <li class="category-item">
                                        <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'] . '?page=banhgato'; ?>">Bánh gato</a>
                                    </li>
                                    <li class="category-item">
                                        <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'] . '?page=banhmi'; ?>">Bánh mì</a>
                                    </li>
                                    <li class="category-item">
                                        <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'] . '?page=banhkem'; ?>">Bánh Kem</a>
                                    </li>
                                </ul>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="scrollToReComment">Phản Hồi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'] . '?page=baiviet'; ?>">Bài viết</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="scrollToFooter">Liên hệ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'] . '?page=tracuu'; ?>" >Tra Cứu</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0 d-none custom-search">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                    <form class="form-inline my-2 my-lg-0 custom-search">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.8045 14.8621L11.8252 10.8828C12.9096 9.5565 13.4428 7.86416 13.3144 6.15581C13.1861 4.44745 12.406 2.85379 11.1356 1.70445C9.86516 0.555106 8.20158 -0.0619731 6.48895 -0.0191518C4.77632 0.0236694 3.14566 0.723114 1.93426 1.93451C0.72287 3.1459 0.0234252 4.77656 -0.019396 6.48919C-0.0622172 8.20183 0.554862 9.8654 1.7042 11.1358C2.85354 12.4062 4.44721 13.1863 6.15556 13.3147C7.86392 13.443 9.55625 12.9098 10.8825 11.8254L14.8619 15.8048C14.9876 15.9262 15.156 15.9934 15.3308 15.9919C15.5056 15.9904 15.6728 15.9203 15.7964 15.7966C15.92 15.673 15.9901 15.5058 15.9916 15.331C15.9932 15.1562 15.926 14.9878 15.8045 14.8621ZM6.66652 12.0001C5.61169 12.0001 4.58054 11.6873 3.70348 11.1013C2.82642 10.5152 2.14283 9.68228 1.73916 8.70774C1.3355 7.7332 1.22988 6.66085 1.43567 5.62628C1.64145 4.59172 2.14941 3.64141 2.89529 2.89553C3.64117 2.14965 4.59147 1.6417 5.62604 1.43591C6.6606 1.23012 7.73296 1.33574 8.7075 1.73941C9.68204 2.14308 10.515 2.82666 11.101 3.70372C11.6871 4.58079 11.9999 5.61193 11.9999 6.66677C11.9983 8.08077 11.4359 9.4364 10.436 10.4362C9.43615 11.4361 8.08052 11.9985 6.66652 12.0001Z" />
                            </svg>                                
                        </button>
                    </form>
                  </nav>
            </div>
        </div>
        <!-- End Header Bottom -->
  
    <!-- End Slider -->
    </header>
       <div class="slider slick">
        <div class="slider-item">
            <img src="./view/img/Property 1=Pink.svg" alt="">
            <div class="slider-content active">
                <div class="slider-cake mb-4">Cupcake cherry chocolate</div>
                <h4 class="slider-title mb-4">Những chiếc bánh ngọt ngào từ Sweet Dreams</h4>
                <p class="slider-description mb-4">Cupcake cherry chocolate là một loại bánh cupcake siêu ngon tuyệt hảo! Chúng có hương vị giống như những quả anh đào mà chúng ta đều yêu thích nhưng ở dạng bánh cupcake thân thiện với bữa tiệc! Ai có thể chống lại? Lựa chọn hoàn hảo cho Lễ tình nhân hoặc sinh nhật.</p>
                <a href="#" class="btn btn-outline-pink slider-btn">Đặt hàng ngay</a>
            </div>
        </div>
        <div class="slider-item">
            <img src="./view/img/Property 1=Blue.svg" alt="">
            <div class="slider-content active">
                <div class="slider-cake mb-4">Cupcake cherry chocolate</div>
                <h4 class="slider-title mb-4">Những bạn nhân viên tâm huyết nhiệt tình</h4>
                <p class="slider-description mb-4">Không chỉ có những chiêc bánh siêu ngon mà còn mang đến một không gian đẹp chill </p>
                <a href="#" class="btn btn-outline-pink slider-btn">Đặt hàng ngay</a>
            </div>
        </div>
        <div class="slider-item">
            <img src="./view/img/Property 1=Green.svg" alt="">
            <div class="slider-content active">
                <div class="slider-cake mb-4">Cupcake cherry chocolate</div>
                <h4 class="slider-title mb-4">Những chiếc bánh ngọt ngào từ Sweet Dreams</h4>
                <p class="slider-description mb-4">Cupcake cherry chocolate là một loại bánh cupcake siêu ngon tuyệt hảo! Chúng có hương vị giống như những quả anh đào mà chúng ta đều yêu thích nhưng ở dạng bánh cupcake thân thiện với bữa tiệc! Ai có thể chống lại? Lựa chọn hoàn hảo cho Lễ tình nhân hoặc sinh nhật.</p>
                <a href="#" class="btn btn-outline-pink slider-btn">Đặt hàng ngay</a>
            </div>
        </div>
    </div>
    
      <style>
        /* CSS styles go here */
        #category {
        position: absolute;
        display:none;
        background-color: #fff; 
        padding: 10px; 
        font-size: 16px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        z-index: 10000000999; 
        }

        #category .category-item {
        list-style: none; 
        }
        .nav-item.dropdown:hover #category {
            display: block; 
        }
        #quantity_nb{
         width:50px;
        }
        #btn_closex{
            margin-left: 100px;
            border-radius: 40%;
            background-color: #FE6A84;
            border: none;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.5)

        }
        #checkout{
            width:200px;
        }
            </style>
            <script>
    // Hàm xử lý khi người dùng nhấp vào nút "x"
    function removeItem(productId) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?')) {
            // Gửi yêu cầu AJAX đến máy chủ
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Xóa phần tử HTML tương ứng khi xóa sản phẩm thành công
                    var itemToRemove = document.getElementById('item_' + productId);
                    itemToRemove.parentNode.removeChild(itemToRemove);
                }
            };
            xhr.open('POST', 'remove_from_cart.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('product_id=' + productId);    
        }
    }
    
    document.getElementById("checkout").addEventListener("click", function(event) {
        // Ngăn chặn hành vi mặc định của form (nếu cần)
        event.preventDefault();

        // Redirect đến trang checkout
        window.location.href = "<?php echo $_SERVER['PHP_SELF'] . '?page=checkout'; ?>";
    });


    document.getElementById('checkout').addEventListener('click', function() {
        var items = document.querySelectorAll('.item-info');
        var data = [];
        items.forEach(function(item) {
            var productId = item.querySelector('input[name="product_id"]').value;
            var quantity = item.querySelector('input[name="quantity"]').value;
            data.push({
                product_id: productId,
                quantity: quantity
            });
        });

        // Gửi dữ liệu qua Ajax
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Xử lý phản hồi từ máy chủ (nếu cần)
                alert(xhr.responseText);
            }
        };
        xhr.send(JSON.stringify(data));
    });
    document.addEventListener("DOMContentLoaded", function() {
        const scrollToFooterLink = document.getElementById("scrollToFooter");
        const footer = document.getElementById("footer");

        scrollToFooterLink.addEventListener("click", function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
            footer.scrollIntoView({ behavior: "smooth" }); // Di chuyển trang đến footer với hiệu ứng mượt
        });
    });
        document.addEventListener("DOMContentLoaded", function() {
        const scrollToFooterLink = document.getElementById("scrollToReComment");
        const footer = document.querySelector(".feedback"); // Lấy phần tử đầu tiên có class "feedback"

        scrollToFooterLink.addEventListener("click", function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
            footer.scrollIntoView({ behavior: "smooth" }); // Di chuyển trang đến footer với hiệu ứng mượt
        });
    });

</script>

         