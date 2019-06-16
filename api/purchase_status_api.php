<?php
    require('../utils/db_connector.php');
    $UserID = $_POST["userid"];
   
    $sql_purchase_pending = "SELECT PURCHASE_ID FROM purchase WHERE UserID='$UserID' AND PURCHASE_STATUS = 'P'";
    $query_purchase_pending = mysqli_query($conn,$sql_purchase_pending);
    $obj_pre = mysqli_fetch_all($query_purchase_pending);

    $sql_purchase_app = "SELECT PURCHASE_ID FROM purchase WHERE UserID='$UserID' AND PURCHASE_STATUS = 'A'";
    $query_purchase_app = mysqli_query($conn,$sql_purchase_app);
    $obj_app = mysqli_fetch_all($query_purchase_app,MYSQLI_ASSOC);

    

    $data = array("pending"=>$obj_pre,'approve'=>$obj_app);
    error_log(json_encode($data));
    echo json_encode($data);


?>