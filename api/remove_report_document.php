<?php
    require("../utils/db_connector.php");

    $purchase_lineitem_id = $_POST["purchase_lineitem_id"];
    $remove_report_document = "
        UPDATE purchase_lineitem
        SET report_document_firebase_ref = NULL, report_document_url = NULL
        WHERE purchase_lineitem_id = '{$purchase_lineitem_id}';
    ";

    if($conn->query($remove_report_document)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    