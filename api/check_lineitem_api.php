<?php
        require('../utils/db_connector.php');
        $UserID = $_POST["userid"];
        $data =array();
        $sql_check_purchase_id_a = "SELECT MAX(PURCHASE_ID) as l_purchase FROM purchase WHERE UserID = '$UserID' AND PURCHASE_STATUS = 'A'";
        $query_check = mysqli_query($conn,$sql_check_purchase_id_a);
        $obj_check = mysqli_fetch_assoc($query_check);
        $purchase_id = $obj_check["l_purchase"];

        $sql_select_lineitem = "SELECT * FROM purchase_lineitem WHERE purchase_id = '$purchase_id'";
        $lineitem = mysqli_query($conn,$sql_select_lineitem);
        while($obj = mysqli_fetch_assoc($lineitem))
        {
            $select_product_name ="SELECT cate_name FROM product_category WHERE cate_id = '".$obj['cate_id']."'";
            $query_product_name = mysqli_query($conn,$select_product_name);
            $product_name = mysqli_fetch_assoc($query_product_name);
            array_push($obj,$product_name); 
            array_push($data,$obj);
        }
        echo json_encode($data);
?>