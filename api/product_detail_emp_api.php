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
    else if ($request == 'product_cate')
    {
        $sql = "SELECT * FROM product_category WHERE parent_cate_id IS NULL";
        $query = mysqli_query($conn,$sql);
        $obj = mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode($obj);
    }
    else if($request == 'product_cate_level_2')
    {
        $cate_id =$_POST["cate_id"];
        $sql = "SELECT * FROM product_category WHERE parent_cate_id = '$cate_id'";
        $query = mysqli_query($conn,$sql);
        $obj = mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode($obj);
    }
    else if($request == 'product_cate_level_3')
    {
        $cate_id =$_POST["cate_id"];
        $sql = "SELECT * FROM product_category WHERE parent_cate_id = '$cate_id'";
        $query = mysqli_query($conn,$sql);
        $obj = mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode($obj);
    }
    else if($request == 'fetch_desc')
    {
        $cate_id =$_POST["cate_id"];
        $sql = "SELECT content_body FROM product_category WHERE cate_id = '$cate_id'";
        $query = mysqli_query($conn,$sql);
        $obj = mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode($obj);
    }
    else if($request == 'add2po')
    {
        $cate_id =$_POST["cate_id"];
        $purchase_id = $_POST["purchase_id"];
        $des = $_POST["des"];
        $app_date = $_POST["app_date"];
        //check ก่อนว่ามีรายการอยู่แล้วหรือไม่
        $sql_check_item = "SELECT * FROM purchase_lineitem WHERE purchase_id = '$purchase_id' AND cate_id = '$cate_id'";
        $query_check_item_ = mysqli_query($conn,$sql_check_item);
        $obj_check_item = mysqli_fetch_assoc($query_check_item_);
        if($obj_check_item <> null)
        {
            echo "already";
        }
        else if ($obj_check_item == null)
        {
            $sql = "INSERT INTO purchase_lineitem(purchase_id,cate_id,des,appointment_date) VALUES('$purchase_id','$cate_id','$des','$app_date')";
            $query = mysqli_query($conn,$sql);
            echo "inserted";
        }
    }
    else if($request == 'del')
    {
        $purchase_id =$_POST["purchase_id"];
        $cate_id = $_POST["cate_id"];
        $sql = "DELETE FROM purchase_lineitem WHERE purchase_id = '$purchase_id' AND cate_id = '$cate_id'";
        $query = mysqli_query($conn,$sql);
        echo "Deleted....";
        
    }
    
?>