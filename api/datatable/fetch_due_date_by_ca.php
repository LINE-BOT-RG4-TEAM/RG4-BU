<?php
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    require('../../utils/db_connector.php');

    $ca = $_GET["ca"];
    $due_date = $_GET["due_date"]; //2019-12-18

    $fetch_due_date_jobs = "
        SELECT FullName
            , ADDRESS
            , CA.CA
            , UserID
            , CODE
            , CODE_EXPLAIN
        FROM history
            JOIN CA ON history.CA = CA.ca
            JOIN BP ON BP.BP = CA.BP
        WHERE DATE_ADD(history.`HISTORY`, INTERVAL 1 YEAR) = '{$due_date}'
            AND history.ca = '{$ca}'
            AND CODE IN ('S301', 'S302', 'S303', 'S304', 'S305')
        GROUP BY 1, 2, 3, 4, 5, 6
    ";

    $due_date_jobs_results = $conn->query($fetch_due_date_jobs);
    $due_date_jobs_obj = $due_date_jobs_results->fetch_all(MYSQLI_ASSOC);
    echo json_encode($due_date_jobs_obj, JSON_UNESCAPED_UNICODE);
?>