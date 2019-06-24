<?php
    require("../utils/db_connector.php");

    $purchase_id = $_POST["purchase_id"];
    $purchase_line_item = $_POST["purchase_line_item"];
    $photo_mode = $_POST["photo_mode"];
    $photo_url = $_POST["photo_url"];

    $update_activity_photo = "
        UPDATE purchase_lineitem
        SET {$photo_mode} = '{$photo_url}'
        WHERE purchase_lineitem_id = '{$purchase_line_item}';
    ";

    if($conn->query($update_activity_photo)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    