  <?php 
    function selectAll_NewProduct($limi){
      $sql = "SELECT * FROM tbl_sanpham ORDER BY id DESC LIMIT ". $limi;
      $dssp = select_sql($sql);
      return $dssp;
    }
    function selectAll_showProduct(){
      $sql = "SELECT * FROM tbl_sanpham";
      $dssp = select_sql($sql);
      return $dssp;
    }
    function allsp(){
        $sql = "SELECT * FROM tbl_sanpham";
        return select_sql($sql);
    }
    function selectAll_Product($trang){
     
      // $tongsp = count(allsp());
      $limit_start=So_SPT*($trang-1);
      $sql = "SELECT * FROM tbl_sanpham ORDER BY id DESC LIMIT ". $limit_start.",".So_SPT;
      $dssp = select_sql($sql);
      return $dssp;
    }
    function phantrang($tranghientai, $sptrentrang) {
      $tongsp = count(allsp());
      $sotrang = ceil($tongsp / $sptrentrang);
      $html_phantrang = "";
      for ($i = 1; $i <= $sotrang; $i++) {
          $link = 'index.php?page=sanpham&trang=' . $i;
          if ($i == $tranghientai) {
              $html_phantrang .= '<a href="' . $link . '"style="background-color:#49D8B9">' . $i . '</a>';
          } else {
              $html_phantrang .= '  <a href="' . $link . '">' . $i . '</a>';
          }
      }
      return $html_phantrang;
  }

  function selectAll_NewProduct1($limi1){

    $sql1 = "SELECT * FROM tbl_sanpham WHERE iddanhmuc =3 ORDER BY id DESC LIMIT ". $limi1;
    $dssp1 = select_sql($sql1);
    return $dssp1;
  }
  function allsp1(){
      $sql1 = "SELECT * FROM tbl_sanpham WHERE iddanhmuc=3 ";
      return select_sql($sql1);
  }
  function selectAll_Product1($trang1){
   
    // $tongsp = count(allsp());
    $limit_start1=So_SPT*($trang1-1);
    $sql1 = "SELECT * FROM tbl_sanpham WHERE iddanhmuc =3 ORDER BY id DESC LIMIT $limit_start1," . So_SPT;
    $dssp1 = select_sql($sql1);
    return $dssp1;
  }
  function phantrang1($tranghientai1, $sptrentrang1) {
    $tongsp1 = count(allsp1());
    $sotrang1 = ceil($tongsp1 / $sptrentrang1);
    $html_phantrang1 = "";
    for ($i = 1; $i <= $sotrang1; $i++) {
        $link1 = 'index.php?page=banhkem&trang=' . $i;
        if ($i == $tranghientai1) {
            $html_phantrang1 .= '<a href="' . $link1 . '"style="background-color:#49D8B9">' . $i . '</a>';
        } else {
            $html_phantrang1 .= '  <a href="' . $link1 . '">' . $i . '</a>';
        }
    }
    return $html_phantrang1;
}
  function phantrang2($tranghientai2, $sptrentrang2) {
    $tongsp2 = count(allsp2());
    $sotrang2 = ceil($tongsp2 / $sptrentrang2);
    $html_phantrang2 = "";
    for ($i = 1; $i <= $sotrang2; $i++) {
        $link2 = 'index.php?page=banhmi&trang=' . $i;
        if ($i == $tranghientai2) {
            $html_phantrang2 .= '<a href="' . $link2 . '"style="background-color:#49D8B9">' . $i . '</a>';
        } else {
            $html_phantrang2 .= '  <a href="' . $link2 . '">' . $i . '</a>';
        }
    }
    return $html_phantrang2;
  }
  function selectAll_NewProduct2($limi2){

    $sql2 = "SELECT * FROM tbl_sanpham WHERE iddanhmuc =2 ORDER BY id DESC LIMIT ". $limi2;
    $dssp2 = select_sql($sql2);
    return $dssp2;
  }
  function allsp2(){
      $sql2 = "SELECT * FROM tbl_sanpham WHERE iddanhmuc=2 ";
      return select_sql($sql2);
  }
  function selectAll_Product2($trang2){
  
    // $tongsp = count(allsp());
    $limit_start2=So_SPT*($trang2-1);
    $sql2 = "SELECT * FROM tbl_sanpham WHERE iddanhmuc =2 ORDER BY id DESC LIMIT $limit_start2," . So_SPT;
    $dssp2 = select_sql($sql2);
    return $dssp2;
  }


  
  function phantrang3($tranghientai3, $sptrentrang3) {
    $tongsp3 = count(allsp3());
    $sotrang3 = ceil($tongsp3 / $sptrentrang3);
    $html_phantrang3 = "";
    for ($i = 1; $i <= $sotrang3; $i++) {
        $link3 = 'index.php?page=banhgato&trang=' . $i;
        if ($i == $tranghientai3) {
            $html_phantrang3 .= '<a href="' . $link3 . '"style="background-color:#49D8B9">' . $i . '</a>';
        } else {
            $html_phantrang3 .= '  <a href="' . $link3 . '">' . $i . '</a>';
        }
    }
    return $html_phantrang3;
  }

  function selectAll_NewProduct3($limi3){
    $sql3 = "SELECT * FROM tbl_sanpham WHERE iddanhmuc =1 ORDER BY id DESC LIMIT ". $limi3;
    $dssp3 = select_sql($sql3);
    return $dssp3;
  }
  function allsp3(){
      $sql3 = "SELECT * FROM tbl_sanpham WHERE iddanhmuc=1 ";
      return select_sql($sql3);
  }
  function selectAll_Product3($trang3){
  
    // $tongsp = count(allsp());
    $limit_start3=So_SPT*($trang3-1);
    $sql3 = "SELECT * FROM tbl_sanpham WHERE iddanhmuc =1 ORDER BY id DESC LIMIT $limit_start3," . So_SPT;
    $dssp3 = select_sql($sql3);
    return $dssp3;
  }


  
  ?>