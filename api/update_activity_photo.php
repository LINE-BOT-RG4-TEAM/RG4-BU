<?php
    require("../utils/db_connector.php");

    $purchase_lineitem_id = $_POST["purchase_lineitem_id"];
    $photo_mode = $_POST["photo_mode"];
    $firebase_ref = $_POST["firebase_ref"];
    $photo_name = $_POST["photo_name"];
    $photo_url = $_POST["photo_url"];

    $insert_activity_photo = "
        INSERT INTO purchase_activity_photo(purchase_lineitem_id, photo_mode, firebase_ref, photo_name, photo_url, upload_timestamp)
        VALUES('{$purchase_lineitem_id}', '{$photo_mode}', '{$firebase_ref}', '{$photo_name}', '{$photo_url}', now());
    ";

    if($conn->query($insert_activity_photo)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    