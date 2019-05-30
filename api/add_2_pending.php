<?php
    require('../utils/db_connector.php');
    $purchase_id = $_POST["purchase_id"];
    $des = $_POST["comment"];
    $cate_id = $_POST["cate_id"];

    $sql_check_item = "SELECT * FROM purchase_lineitem WHERE purchase_id = '$purchase_id' AND cate_id = '$cate_id'";
    $query_check_item_ = mysqli_query($conn,$sql_check_item);
    $obj_check_item = mysqli_fetch_assoc($query_check_item_);
    if($obj_check_item <> null)
    {
        echo "already";
    }
    else if ($obj_check_item == null)
    {
        $sql_insertlineitem = "INSERT INTO purchase_lineitem(purchase_id,cate_id,des) VALUES('$purchase_id','$cate_id','$des')";
        mysqli_query($conn,$sql_insertlineitem);
        echo "inserted";
    }

?>