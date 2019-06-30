<?php
    require("../utils/db_connector.php");

    $purchase_lineitem_id = $_POST["purchase_lineitem_id"];
    $report_document_firebase_ref = $_POST["report_document_firebase_ref"];
    $report_document_url = $_POST["report_document_url"];

    $update_report_document = "
        UPDATE purchase_lineitem
        SET report_document_firebase_ref = '{$report_document_firebase_ref}', 
            report_document_url = '{$report_document_url}'
        WHERE purchase_lineitem_id = '{$purchase_lineitem_id}'
    ";

    if($conn->query($update_report_document)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    