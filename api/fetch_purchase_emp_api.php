<?php
    //ดึงข้อมูลใบสั่งซ้อไปแสดงหน้า ใบสั่งซื้อฝั่งพนักงาน
    require('../utils/db_connector.php');

    $purchase_id = $_POST["purchase_id"];

    $sql_purchase = "
                    SELECT 
                        bp.CUSTOMER_NAME,
                        ca.CA,
                        ca.BUSINESS_TYPE,
                        ca.ADDRESS,
                        ca.HML_Type,
                        ca.KAM_TYPE,
                        ca.KAMR,
                        ca.UserID,
                        bp.BP,
                        ca.FullName,
                        ca.CA_TEL,
                        ca.CA_EMAIL
                    FROM 
                        purchase  
                    INNER JOIN ca 
                    ON purchase.UserID = ca.UserID
                    INNER JOIN bp
                    ON ca.BP = bp.BP 
                    WHERE PURCHASE_ID = '$purchase_id'";
    $query = mysqli_query($conn,$sql_purchase);

    $obj = mysqli_fetch_all($query,MYSQLI_ASSOC);

    echo json_encode($obj);



?>