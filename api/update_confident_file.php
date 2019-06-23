<?php
    require("../utils/db_connector.php");

    $po_number = $_POST["PONumber"];
    $download_URL = $_POST["downloadURL"];

    $update_confident_file = "
        UPDATE purchase
        SET confident_document = '{$download_URL}', document_upload_datetime = now()
        WHERE purchase_id = '{$po_number}';
    ";

    if($conn->query($update_confident_file)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    