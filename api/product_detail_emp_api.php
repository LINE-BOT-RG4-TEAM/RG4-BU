<?php
    //ใช้ดึงค่าสินค้ามาแสดงในหน้า modal ตอนแก้ไขสินค้าฝั่งพนักงาน
    require('../utils/db_connector.php');
    $request = $_POST["request"];
    if($request == 'modal')
    {
        $purchase_id =$_POST["purchase_id"];
        $cate_id = $_POST["cate_id"];
        $sql = "
                    SELECT 
                        purchase_lineitem.*,
                        product_category.cate_name AS cate_name 
                    FROM 
                        purchase_lineitem
                    INNER JOIN 
                        product_category
                    ON 
                        purchase_lineitem.cate_id = product_category.cate_id  
                    WHERE 
                        purchase_lineitem.purchase_id = '$purchase_id' 
                    AND 
                        purchase_lineitem.cate_id = '$cate_id'";
        $query = mysqli_query($conn,$sql);
        $obj = mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode($obj);
    }
    else if($request == 'edit')
    {
        $purchase_id =$_POST["purchase_id"];
        $cate_id = $_POST["cate_id"];
        $des = $_POST["des"];
        $appointment_date = $_POST["appointment_date"];
        $sql = "UPDATE purchase_lineitem SET des = '$des',appointment_date = '$appointment_date' WHERE purchase_id = '$purchase_id' AND cate_id = '$cate_id'";
        $query = mysqli_query($conn,$sql);
        /*if(!mysqli_query($conn,$sql))
        {
            die(mysqli_error($conn))
        }*/
        echo $purchase_id." ".$cate_id;
        
    }
    
?>