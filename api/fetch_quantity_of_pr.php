<?php
    session_start();
    require("../utils/db_connector.php");

    if(!array_key_exists("role", $_SESSION)){
        exit(0);
    }

    // check menu from user role
    $role = $_SESSION['role'];
    $existing_po_emp_menu = "
        SELECT menu_action
        FROM menu_role
        WHERE `role` = '{$role}' 
                AND `menu_action` = 'po_emp'
                AND `is_active` = 'A'
    ";
    $existing_result = $conn->query($existing_po_emp_menu);
    if($existing_result->num_rows > 0){
        // check quantity of pr
        $pea_code = $_SESSION["pea_code"];
        $fetch_pr_quantity = "
            SELECT 
                purchase.PURCHASE_ID AS purchase_id,
                ca.CA AS ca,
                bp.CUSTOMER_NAME AS cus_name ,
                COUNT(purchase_lineitem.purchase_id) AS service_num
            FROM purchase 
            INNER JOIN ca ON purchase.UserID = ca.UserID
            INNER JOIN bp ON ca.BP = bp.BP 
            INNER JOIN purchase_lineitem ON purchase_lineitem.purchase_id = purchase.PURCHASE_ID
            WHERE purchase.PURCHASE_STATUS = 'P'
                AND ca.PEA_CODE = '{$pea_code}'
            GROUP BY purchase_lineitem.purchase_id
        ";
        $quantity_results = $conn->query($fetch_pr_quantity);
        if($quantity_results->num_rows > 0){
            echo json_encode(array("quantity" => $quantity_results->num_rows));
            http_response_code(200);
            exit(0);
        }
        echo json_encode(array("quantity" => 0));
        http_response_code(200);
        exit(0);
    }

    echo json_encode(array("quantity" => 0));
    http_response_code(204);
    exit(0);
