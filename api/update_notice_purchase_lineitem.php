<?php
    require("../utils/db_connector.php");

    $purchase_lineitem_id = $_POST["purchase_lineitem_id"];
    $notice = $_POST["notice"];

    if(strlen(trim($notice)) == 0){
        $set_value_stmt = "notice = NULL ";
    }else{
        $set_value_stmt = "notice = '{$notice}' ";
    }

    $update_notice = "
        UPDATE purchase_lineitem
        SET $set_value_stmt
        WHERE purchase_lineitem_id = '{$purchase_lineitem_id}'
    ";

    if($conn->query($update_notice)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    