<?php
    require("../utils/db_connector.php");

    $purchase_lineitem_id = $_POST["purchase_lineitem_id"];
    $contact_time = $_POST["contact_time"];

    if(strlen(trim($contact_time)) == 0){
        $set_value_stmt = "contact_time = NULL ";
    }else{
        $set_value_stmt = "contact_time = '{$contact_time}' ";
    }

    $update_contact_time = "
        UPDATE purchase_lineitem
        SET $set_value_stmt
        WHERE purchase_lineitem_id = '{$purchase_lineitem_id}'
    ";

    if($conn->query($update_contact_time)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    