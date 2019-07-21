<?php
    require('../../utils/db_connector.php');
    session_start();

    $pea_code = $_SESSION["pea_code"];
    $pea_district = substr($pea_code, 0, 1);

    $fetch_all_pr_by_district = "
        SELECT purchase.PURCHASE_ID
            , bp.`BP`
            , ca.`CA`
            , bp.CUSTOMER_NAME
            , purchase.FullName
            , purchase.CA_TEL
            , office.pea_name
            , COUNT(purchase_lineitem_id) AS 'quantity_service'
        FROM purchase
            JOIN ca ON purchase.CA = ca.`CA`
            JOIN office ON ca.pea_code = office.pea_code
            JOIN bp ON bp.`BP` = ca.`BP`
            JOIN purchase_lineitem ON purchase.PURCHASE_ID = purchase_lineitem.PURCHASE_ID
        WHERE `ca`.pea_code LIKE '$pea_district%'
                AND purchase.PURCHASE_STATUS = 'P'
        GROUP BY 1, 2, 3, 4, 5, 6, 7
        ORDER BY office.pea_code, purchase.PURCHASE_ID
    ";

    $pr_results = $conn->query($fetch_all_pr_by_district);
    $pr_list = $pr_results->fetch_all(MYSQLI_ASSOC);
    echo json_encode($pr_list, JSON_UNESCAPED_UNICODE);
