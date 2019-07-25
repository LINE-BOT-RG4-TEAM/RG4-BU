<?php
    require("../../utils/db_connector.php");

    $criteria_list = array();

    $raw_cust_name = $_GET['cust_name'];
    if(strlen($raw_cust_name) > 0){
        $cust_name_list = array_map('trim', explode(',', $raw_cust_name));
        if(count($cust_name_list) > 0){
            $cust_name_list_string = implode("|", $cust_name_list);
            array_push($criteria_list, "CUSTOMER_NAME REGEXP '{$cust_name_list_string}'");
        }
    }

    // set for addresses
    $raw_address = $_GET['address'];
    if(strlen($raw_address) > 0 ){
        $address_list = array_map('trim', explode(',', $raw_address));
        if(count($address_list) > 0){
            $address_list_string = implode("|", $address_list);
            array_push($criteria_list, "address REGEXP '{$address_list_string}'");
        }
    }

    // convert array to string
    $criteria_string = implode(" AND ", $criteria_list) ;
    $fetch_customer = "
        SELECT CONCAT(office.PEA_CODE, '-', office.PEA_NAME) AS 'PEA_NAME'
                , bp.BP           
                , CONCAT('0', ca.CA) AS `CA`
                , bp.CUSTOMER_NAME
                , ca.ADDRESS
                , ca.BUSINESS_TYPE
                , UserID
        FROM ca 
            JOIN bp ON bp.BP = ca.bp
            JOIN office ON office.pea_code = ca.PEA_CODE
        WHERE {$criteria_string}
        ORDER BY 1, 3, 4;
    ";
    // echo $fetch_customer;
    $customer_results = $conn->query($fetch_customer);
    $all_results = $customer_results->fetch_all(MYSQLI_ASSOC);
    echo json_encode($all_results, JSON_UNESCAPED_UNICODE);
    exit(0);