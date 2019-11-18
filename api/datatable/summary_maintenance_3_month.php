<?php
    set_time_limit(0);
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    require('../../utils/db_connector.php');

    // get current date
    // $today = '2019-11-07';
    $today = date("Y-m-d");

    // get current pea_code 
    $pea_code = $_SESSION['pea_code'];
    $pea_branch_criteria = "";
    if(substr($pea_code, -5) == "00000"){
        $pea_district = substr($pea_code, 0, 1);
        $pea_branch_criteria = "history.PEA_CODE like '{$pea_district}%'";
    } else {
        $pea_branch_criteria = "history.PEA_CODE = '$pea_code'";
    }

    $fetch_summary_jobs = "
        SELECT CONCAT(history.pea_code, ' - ', office.pea_name) AS office_name
                , ca.CA
                , bp.CUSTOMER_NAME
                , CODE_EXPLAIN
                , PAYMENT
                , DATE_ADD(`HISTORY`, INTERVAL 1 YEAR) AS 'due_date'
        FROM history
                JOIN ca ON history.CA = ca.CA
                JOIN bp ON ca.BP = bp.BP
                JOIN office ON office.PEA_CODE = history.PEA_CODE COLLATE utf8_unicode_ci
        WHERE DATE_ADD(history.`HISTORY`, INTERVAL 9 MONTH) = '{$today}'
                AND CODE IN ('S301', 'S302', 'S303', 'S304', 'S305')
                AND {$pea_branch_criteria}
        ORDER BY 6 DESC
    ";

    $summary_job_3_month_results = $conn->query($fetch_summary_jobs);
    $summary_job_3_month_obj = $summary_job_3_month_results->fetch_all(MYSQLI_ASSOC);
    echo json_encode($summary_job_3_month_obj, JSON_UNESCAPED_UNICODE);