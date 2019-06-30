<?php
    require('../../utils/db_connector.php');

    if(!array_key_exists("purchase_id", $_GET) 
      || (is_null($_GET['purchase_id']) 
      || empty($_GET['purchase_id']))){
    echo "ท่านเข้าดูรายละเอียดลูกค้าไม่ถูกต้อง เนื่องจากไม่มีข้อมูล CA";
    exit(1);
  }
  $purchase_id = $_GET["purchase_id"];
  $fetch_automatic = "
    SELECT purchase_lineitem.*
          , product_category.cate_name 
          , count(case when photo_mode = 'before_operate' then 1 end) as 'quantity_before_operate'
          , count(case when photo_mode = 'after_operate' then 1 end) as 'quantity_after_operate'
    FROM 
      purchase_lineitem
        INNER JOIN product_category ON purchase_lineitem.cate_id = product_category.cate_id 
        LEFT JOIN purchase_activity_photo ON purchase_lineitem.purchase_lineitem_id = purchase_activity_photo.purchase_lineitem_id
    WHERE purchase_id='$purchase_id'
    GROUP BY purchase_lineitem.purchase_lineitem_id
  ";

  $fetch_automatic_query = $conn->query($fetch_automatic);
  $ca_obj = $fetch_automatic_query->fetch_all(MYSQLI_ASSOC);
  echo json_encode($ca_obj, JSON_UNESCAPED_UNICODE);
?>