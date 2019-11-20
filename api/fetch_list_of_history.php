<?php
    session_start();
    require('../utils/db_connector.php');

    // get current pea_code 
    $pea_code = $_SESSION['pea_code'];
    $pea_branch_criteria = "";
    if(substr($pea_code, 1, 5) == "00000"){
        $pea_district = substr($pea_code, 0, 1);
        $pea_branch_criteria = "ca.PEA_CODE like '{$pea_district}%'";
    } else {
        $pea_branch_criteria = "ca.PEA_CODE = '$pea_code'";
    }

    $code = ($_POST['code']);

    $data_row = json_decode($_POST['data_row'], true);
    $year = $data_row['year'];
    $is_monthly = array_key_exists("month_no", $data_row);
    $is_quarter = array_key_exists("quarter", $data_row);
    if($is_monthly){
        $month_no = $data_row["month_no"];
        $where_criteria = "
            YEAR(DATE_ADD(`HISTORY`, INTERVAL 1 YEAR)) = '{$year}'
            AND MONTH(DATE_ADD(`HISTORY`, INTERVAL 1 YEAR)) = '{$month_no}'
        ";
    } else if($is_quarter) {
        $quarter = $data_row["quarter"];
        $where_criteria = "
            YEAR(DATE_ADD(`HISTORY`, INTERVAL 1 YEAR)) = '{$year}'
            AND QUARTER(DATE_ADD(`HISTORY`, INTERVAL 1 YEAR)) = '{$quarter}'
        ";
    }

    $fetch_list_of_due_date = "
        SELECT  `bp`.BP
            ,`ca`.CA
            , `history`.`HISTORY` AS `invoice_date`
            , date_add(`history`.`HISTORY`, INTERVAL 1 YEAR) AS `next_due_date`
            , `history`.CODE_EXPLAIN
            , `bp`.CUSTOMER_NAME
            , `history`.PAYMENT,
            , CONCAT(office.PEA_CODE, ' - ', office.PEA_NAME) AS 'pea_name'
        FROM `history` 
        JOIN `ca` ON `ca`.CA = `history`.CA
        JOIN `bp` ON `bp`.BP = `ca`.BP
        JOIN `office` ON `ca`.PEA_CODE = office.PEA_CODE
        WHERE `history`.CODE = '{$code}'
            AND {$where_criteria}
            AND {$pea_branch_criteria}
    ";

    $list_of_due_date_results = $conn->query($fetch_list_of_due_date);
    $list_of_due_date_obj = $list_of_due_date_results->fetch_all(MYSQLI_ASSOC);
    echo json_encode($list_of_due_date_obj, JSON_UNESCAPED_UNICODE);
?>