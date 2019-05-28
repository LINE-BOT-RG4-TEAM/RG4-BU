<?php
    require('../utils/db_connector.php');
    $UserID = $_POST["userid"];
   
    $sql_purchase_pre = "SELECT PURCHASE_ID FROM purchase WHERE UserID='$UserID' AND PURCHASE_STATUS = 'P'";
    $query_purchase_pre = mysqli_query($conn,$sql_purchase_pre);
    $obj_pre = mysqli_fetch_all($query_purchase_pre);

    $sql_purchase_app = "SELECT PURCHASE_ID FROM purchase WHERE UserID='$UserID' AND PURCHASE_STATUS = 'A'";
    $query_purchase_app = mysqli_query($conn,$sql_purchase_app);
    $obj_app = mysqli_fetch_all($query_purchase_app);

    

    $data = array("pre"=>$obj_pre,'app'=>$obj_app);

    echo json_encode($data);


?>