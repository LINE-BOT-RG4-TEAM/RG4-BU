<?php
    require("../utils/db_connector.php");

    $purchase_id = $_POST["purchase_id"];

    $remove_confident_file = "
        UPDATE purchase
        SET confident_document = NULL, document_upload_datetime = NULL
        WHERE purchase_id = '{$purchase_id}';
    ";

    if($conn->query($remove_confident_file)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    