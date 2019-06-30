<?php
    require("../utils/db_connector.php");

    $purchase_lineitem_id = $_POST["purchase_lineitem_id"];
    $notice = $_POST["notice"];

    $update_notice = "
        UPDATE purchase_lineitem
        SET notice = '{$notice}'
        WHERE purchase_lineitem_id = '{$purchase_lineitem_id}'
    ";

    if($conn->query($update_notice)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    