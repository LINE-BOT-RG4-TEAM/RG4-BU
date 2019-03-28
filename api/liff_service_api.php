<?php
    require('../utils/db_connector.php');
    $sql_cate_product = "SELECT * FROM product_category WHERE parent_cate_id IS NULL ";
    $query_cate_product = mysqli_query($conn,$sql_cate_product);
    $data = array();
    while($obj = mysqli_fetch_assoc($query_cate_product))
    {
        array_push($data,$obj);
    }
    echo json_encode($data);
?>