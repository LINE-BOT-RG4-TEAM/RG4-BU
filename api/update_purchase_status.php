<?php
    require("../utils/db_connector.php");

    $purchase_id = $_POST["purchase_id"];
    $purchase_status = $_POST["set_status_to"];

    $update_purchase_status = "
        UPDATE purchase
        SET PURCHASE_STATUS = '{$purchase_status}'
        WHERE purchase_id = '{$purchase_id}'
    ";

    if($conn->query($update_purchase_status)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    