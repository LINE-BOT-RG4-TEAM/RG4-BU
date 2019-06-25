<?php
    require("../utils/db_connector.php");

    $purchase_id = $_POST["purchase_id"];
    $purchase_line_item = $_POST["purchase_line_item"];
    $remove_photo_mode = $_POST["remove_photo_mode"];

    $remove_activity_photo = "
        UPDATE purchase_lineitem
        SET {$remove_photo_mode} = NULL
        WHERE purchase_lineitem_id = '{$purchase_line_item}';
    ";

    if($conn->query($remove_activity_photo)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    