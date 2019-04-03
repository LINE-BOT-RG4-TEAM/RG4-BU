<?php 
require('../utils/db_connector.php');
$sql_check_purchase_id = "SELECT LAST(PURCHASE_ID) as l_purchase FROM purchase";
$query_check = mysqli_query($conn,$sql_check_purchase_id);
$obj_check = mysqli_fetch_assoc($query_check);
if($obj_check["l_purchase"] == null)
{
    echo "Next Purchase NO. IS PO00001" ;
    $sql_insert_po = "INSERT INTO purchase(PURCHASE_ID) VALUE('PO00001')";
    mysqli_query($conn,$sql_insert_po);
}
else
{
    $last_purchase = $obj_check["l_purchase"];
    $num_last_purchasr = substr($last_purchase,2,5);
    $num_new_purchase = str_pad($num_last_purchasr + 1, 5, 0, STR_PAD_LEFT)
    $new_purchase = "PO".$num_new_purchase;
    $sql_insert_po = "INSERT INTO purchase(PURCHASE_ID) VALUE('$new_purchase')";
    mysqli_query($conn,$sql_insert_po);
    echo $new_purchase;
}
?>