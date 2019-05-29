<?php
    require('../utils/db_connector.php');
    $purchase = $_POST["purchase_id"];

    $sql_purchase = "SELECT * FROM purchase_lineitem INNER JOIN product_category ON purchase_lineitem.cate_id = product_category.cate_id WHERE purchase_lineitem.purchase_id='$purchase'";
    $query_purchase = mysqli_query($conn,$sql_purchase);
    $obj_purchase = mysqli_fetch_all($query_purchase,MYSQLI_ASSOC);

    //echo $purchase."from fetch pending api";

    echo json_encode($obj_purchase);
?>