<?php
$show_post = select_sql("SELECT * FROM post where idpost =1");
$showall_post = "";
foreach ($show_post as $item) {  
    extract($item);
    $showall_post .= '
        <div class="post-thumb">
            <h1>'.$namepost.'</h1>
            <img src="view/img/'.$image.'" alt="" class="imgpost">
            <p class="post-excerpt">
                '.$content.'
            </p>
        </div>';
}
$show_post2 = select_sql("SELECT * FROM post where idpost =2");
$showall_post2 = "";
foreach ($show_post2 as $item) {  
    extract($item);
    $showall_post2 .= '
        <div class="post-thumb">
            <h1>'.$namepost.'</h1>
            <img src="view/img/'.$image.'" alt="" class="imgpost">
            <p class="post-excerpt">
                '.$content.'
            </p>
        </div>';
}
$show_post3 = select_sql("SELECT * FROM post where idpost =3");
$showall_post3 = "";
foreach ($show_post3 as $item) {  
    extract($item);
    $showall_post3 .= '
        <div class="post-thumb">
            <h1>'.$namepost.'</h1>
            <img src="view/img/'.$image.'" alt="" class="imgpost">
            <p class="post-excerpt">
                '.$content.'
            </p>
        </div>';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển thị danh sách bài viết bằng html css</title>
    <link rel="stylesheet" href="style.css">
</head>
 
<body>
    <div class=containertitle>
        <div class=containertitle1>
    <div class="wapper">
        <h1>Sale </h1>
        <div class="list-post">
               <!-- HTMLsadadasdasads -->
               <?=$showall_post?>
              
    </div>
    </div>

    <div class="wapper">
        <h1>Voucher</h1>
        <div class="list-post">
        <?=$showall_post2?>
    </div>
    </div>

    <div class="wapper" >
        <h1>Các bài viết xã hội</h1>
        <div class="list-post">
        <?=$showall_post3?>
               
    </div>
    </div>
    </div>
    </div>
    <div id="myModal" class="modal">
    <div class="modal-content">
        <p class="full-text"></p>
    </div>
</div>
</body>
 
</html>
<style>
        * {
            margin: 0px;
            padding: 0px;
        }
        
        ul {
            list-style: none;
        }
        
        a {
            text-decoration: none;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.2;
        }
        .containertitle1{
            display:flex;

        }
        .wapper {
            max-width: 30%;
            background-color: #fff;
            margin: 30px auto;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
        }
            
        
        .post-thumb{
            margin-top:26px;
            border-radius:10%;
            border:1px solid #FE6A84;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
        }
        .post-thumb:hover{
            background-color: #D8D8D8; /* Thay đổi màu nền khi hover */
        }
        .post-thumb:hover img {
            filter: brightness(85%); /* Thay đổi độ sáng của ảnh khi hover */
        }
        .post-excerpt {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            cursor: pointer;

    }
        h1 {
            padding: 20px 0px;
            text-align: center;
        }
        .imgpost{
            margin-left:10px;
            width: 380px;
            height: 200px;
            border-radius:10%;
            border-radius:10%;
            border:1px solid #FE6A84;
        }
        .post-excerpt .read-more {
                display: none; /* Ẩn nội dung "xem thêm" ban đầu */
         } 
         .post-excerpt .read-more {
         display: none; /* Ẩn nội dung "xem thêm" ban đầu */
         }
                .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%;
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.9); 
            padding-top: 60px;
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 

        }
        .full-text{
            margin-top:20px;
            font-size:16px;
            font-family:Arial,Helvetica;
        }

        /* Close Button */
            



</style>\
<script>
    // JavaScript
    document.addEventListener("DOMContentLoaded", function() {
    const readMoreLinks = document.querySelectorAll(".post-thumb .read-more");
    readMoreLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
            const excerpt = this.parentElement;
            excerpt.classList.add("show-full"); // Thêm lớp 'show-full' để hiển thị nội dung đầy đủ
        });
    }); 

    const postThumbs = document.querySelectorAll(".post-thumb");
    postThumbs.forEach(function(thumb) {
        thumb.addEventListener('click', function() {
            // Get the modal
            var modal = document.getElementById("myModal");
            // Get the paragraph element inside modal
            var modalText = modal.querySelector('.full-text');
            // Set the full text to modal
            modalText.textContent = thumb.querySelector('.post-excerpt').textContent;
            modal.style.display = "block";
        });
    });
});

// Close the modal when clicking on the close button or anywhere outside the modal
window.addEventListener('click', function(event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

</script>
<script src="./view/dist/js/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="./view/libs/bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js"></script>
    <!-- Slick -->
    <script src="./view/libs/slick/slick.min.js"></script>
    <!-- JS SDK -->
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0&appId=655046728452857&autoLogAppEvents=1" nonce="3SKqktrU"></script>
    <!-- My Script -->
    <script src="./view/dist/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
