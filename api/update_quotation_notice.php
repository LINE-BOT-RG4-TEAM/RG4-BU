<?php
    require("../utils/db_connector.php");

    $purchase_lineitem_id = $_POST["purchase_lineitem_id"];
    $quotation_notice = $_POST["quotation_notice"];

    if(strlen(trim($quotation_notice)) == 0){
        $set_value_stmt = "quotation_notice = NULL ";
    }else{
        $set_value_stmt = "quotation_notice = '{$quotation_notice}' ";
    }

    $update_quotation_notice = "
        UPDATE purchase_lineitem
        SET $set_value_stmt
        WHERE purchase_lineitem_id = '{$purchase_lineitem_id}'
    ";

    if($conn->query($update_quotation_notice)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    