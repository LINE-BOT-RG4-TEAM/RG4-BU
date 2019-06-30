<?php
    require("../utils/db_connector.php");

    $photo_id = $_POST["photo_id"];
    $remove_activity_photo = "
        DELETE FROM purchase_activity_photo
        WHERE id = '{$photo_id}';
    ";

    if($conn->query($remove_activity_photo)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    