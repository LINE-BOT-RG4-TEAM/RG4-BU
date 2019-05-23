<?php
    require('../utils/db_connector.php');
    $UserID = $_POST["userid"];
    $item = $_POST["item"];
    
    if($item == 'cart')
    {
        //////เลือกใบสั่งซื้อ ที่มีสถานะ A ของ UID นั้น...
        $sql_check_purchase_id_a = "SELECT MAX(PURCHASE_ID) as l_purchase FROM purchase WHERE UserID = '$UserID' AND PURCHASE_STATUS = 'A'";
        $query_check = mysqli_query($conn,$sql_check_purchase_id_a);
        $obj_check = mysqli_fetch_assoc($query_check);
        $purchase_id = $obj_check["l_purchase"];

        $sql_select_lineitem = "SELECT count(purchase_id) as num_purchase FROM purchase_lineitem WHERE purchase_id = '$purchase_id'";
        $num_lineitem = mysqli_query($conn,$sql_select_lineitem);
        $obj = mysqli_fetch_assoc($num_lineitem);
        echo $obj["num_purchase"];
    }
    else if($item == 'modal')
    {
        $sql_check_purchase_id_a = "SELECT MAX(PURCHASE_ID) as l_purchase FROM purchase WHERE UserID = '$UserID' AND PURCHASE_STATUS = 'A'";
        $query_check = mysqli_query($conn,$sql_check_purchase_id_a);
        $obj_check = mysqli_fetch_assoc($query_check);
        $purchase_id = $obj_check["l_purchase"];

        $sql_select_lineitem = "SELECT * FROM purchase_lineitem WHERE purchase_id = '$purchase_id'";
        $lineitem = mysqli_query($conn,$sql_select_lineitem);
        $obj = mysqli_fetch_assoc($num_lineitem);
        echo $obj;

    }
    
?>