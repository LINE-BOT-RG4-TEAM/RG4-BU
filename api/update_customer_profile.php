<?php
    require("../utils/db_connector.php");

    $ca = $_POST["CA"];
    $changed_list = $_POST["changed_data"];

    $criteria_sql_list = array();
    foreach($changed_list as $field_changed){
        $field_name = key((array)$field_changed);
        $field_value = $field_changed[$field_name];
        $criteria_sql_list[] = "{$field_name} = '{$field_value}'";
    }

    if(count($criteria_sql_list) == 0){
        http_response_code(404);
        exit(1);
    }

    $criteria_sql_str = implode(", ", $criteria_sql_list);
    $update_statement = "
        UPDATE `ca`
        SET {$criteria_sql_str}
        WHERE `CA` = '{$ca}';
    ";
    if($conn->query($update_statement)){
        http_response_code(200);
        exit(0);
    } else {
        http_response_code(404);
        exit(1);
    }
    