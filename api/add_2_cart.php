<?php 
require('../utils/db_connector.php');
$UserID = $_POST["userid"];
$cate_id = $_POST["cate_id"];
$comment = $_POST["comment"];
//////check ใบสั่งซื้อที่มีสถานะ S อยู่ในสถานะ Shoping
$sql_check_purchase_id_a = "SELECT MAX(PURCHASE_ID) as l_purchase FROM purchase WHERE UserID = '$UserID' AND PURCHASE_STATUS = 'S'";
$query_check = mysqli_query($conn,$sql_check_purchase_id_a);
$obj_check = mysqli_fetch_assoc($query_check);

///// check ใบสั่งซื้อที่มีสถานะ A คือใบสั่งซื้อที่ approvr แล้ว
$sql_check_purchase_id_c = "SELECT MAX(PURCHASE_ID) as l_purchase FROM purchase WHERE UserID = '$UserID' AND PURCHASE_STATUS = 'A'";
$query_check_c = mysqli_query($conn,$sql_check_purchase_id_c);
$obj_check_c = mysqli_fetch_assoc($query_check_c); 

if($obj_check["l_purchase"] == null && $obj_check_c["l_purchase"] == null)
{
    $sql_max_purchase = "SELECT MAX(PURCHASE_ID) as l_purchase FROM purchase";
    $query_max_purchase = mysqli_query($conn,$sql_max_purchase);
    $obj_max_purchase = mysqli_fetch_assoc($query_max_purchase);

    $last_purchase = $obj_max_purchase["l_purchase"];
    $num_last_purchasr = substr($last_purchase,2,5);
    $num_new_purchase = str_pad($num_last_purchasr + 1, 5, 0, STR_PAD_LEFT);
    $new_purchase = "PO".$num_new_purchase;

    $sql_insert_po = "INSERT INTO purchase(PURCHASE_ID,UserID) VALUES('$new_purchase','$UserID')";
    mysqli_query($conn,$sql_insert_po);

    $sql_insertlineitem = "INSERT INTO purchase_lineitem(purchase_id,cate_id,des) VALUES('$new_purchase','$cate_id','$comment')";
    mysqli_query($conn,$sql_insertlineitem);
    echo "if 1";
    
}
else if($obj_check["l_purchase"] <> null)
{
    $purchase_id = $obj_check["l_purchase"];

    $sql_check_product_in_cart = "SELECT * FROM purchase_lineitem WHERE purchase_id = '$purchase_id' AND cate_id = '$cate_id'";
    $sql_check_product_in_cart_query = mysqli_query($conn,$sql_check_product_in_cart);
    $obj_check_incart = mysqli_fetch_assoc($sql_check_product_in_cart_query);
    if($obj_check_incart <> null)
    {
        echo "already";
    }
    else if($obj_check_incart == null)
    {
        $sql_insertlineitem = "INSERT INTO purchase_lineitem(purchase_id,cate_id,des) VALUES('$purchase_id','$cate_id','$comment')";
        mysqli_query($conn,$sql_insertlineitem);
        echo "inserted";
    }
    
}
else if($obj_check_c["l_purchase"] <> null && $obj_check["l_purchase"] == null )
{
    $sql_max_purchase = "SELECT MAX(PURCHASE_ID) as l_purchase FROM purchase";
    $query_max_purchase = mysqli_query($conn,$sql_max_purchase);
    $obj_max_purchase = mysqli_fetch_assoc($query_max_purchase);

    $last_purchase = $obj_max_purchase["l_purchase"];
    $num_last_purchasr = substr($last_purchase,2,5);
    $num_new_purchase = str_pad($num_last_purchasr + 1, 5, 0, STR_PAD_LEFT);
    $new_purchase = "PO".$num_new_purchase;

    $sql_insert_po = "INSERT INTO purchase(PURCHASE_ID,UserID) VALUES('$new_purchase','$UserID')";
    mysqli_query($conn,$sql_insert_po);

    $sql_insertlineitem = "INSERT INTO purchase_lineitem(purchase_id,cate_id,des) VALUES('$new_purchase','$cate_id','$comment')";
    mysqli_query($conn,$sql_insertlineitem);
    echo "if 3";
}
?>