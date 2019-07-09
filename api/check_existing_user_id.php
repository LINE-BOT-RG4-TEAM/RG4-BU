<?php
    session_start();
    require('../utils/db_connector.php');

    $userId = $_POST["userId"];

    $fetch_existing_user_id = "
        SELECT UserID
        FROM `ca`
        WHERE UserID = '{$userId}';
    ";
    $existing_results = $conn->query($fetch_existing_user_id);

    if($existing_results->num_rows > 0) {
        http_response_code(200);
        echo json_encode(array("status"=>"200"), JSON_UNESCAPED_UNICODE);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }