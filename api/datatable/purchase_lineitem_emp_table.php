<?php
    require('../../utils/db_connector.php');

    if(!array_key_exists("purchase_id", $_GET) 
      || (is_null($_GET['purchase_id']) 
      || empty($_GET['purchase_id']))){
    echo "ท่านเข้าดูรายละเอียดลูกค้าไม่ถูกต้อง เนื่องจากไม่มีข้อมูล CA";
    exit(0);
  }
  $purchase_id = $_GET["purchase_id"];
    $fetch_automatic = "
                        SELECT 
	                        purchase_lineitem.*,product_category.cate_name 
                        FROM 
	                        purchase_lineitem
                        INNER JOIN product_category
                        ON purchase_lineitem.cate_id = product_category.cate_id 
                        WHERE 
	                    purchase_id='$purchase_id'";
  
    $fetch_automatic_query = $conn->query($fetch_automatic);
    $ca_obj = $fetch_automatic_query->fetch_all(MYSQLI_ASSOC);
    echo json_encode($ca_obj, JSON_UNESCAPED_UNICODE);




?>