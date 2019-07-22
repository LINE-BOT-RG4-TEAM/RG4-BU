<?php
    define('LINE_GET_PROFILE_URI', 'https://api.line.me/v2/bot/profile/');
    require('../../utils/db_connector.php');
    session_start();

    $pea_code = $_SESSION["pea_code"];
    $pea_district = substr($pea_code, 0, 1);

    $fetch_all_pr_by_district = "
        SELECT purchase.PURCHASE_ID
            , bp.`BP`
            , ca.`CA`
            , purchase.UserID
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
        GROUP BY 1, 2, 3, 4, 5, 6, 7, 8
        ORDER BY office.pea_code, purchase.PURCHASE_ID
    ";

    $pr_results = $conn->query($fetch_all_pr_by_district);
    $pr_list = $pr_results->fetch_all(MYSQLI_ASSOC);
    $new_pr_list = array();
    foreach($pr_list as $pr_row) {
        $userId = $pr_row['UserID'];
        $profile_obj = getProfileByUserId($userId);
        $pr_row["displayName"] = $profile_obj["displayName"];
        $pr_row["pictureUrl"] = $profile_obj["pictureUrl"];
        $new_pr_list[] = $pr_row;
    }
    echo json_encode($new_pr_list, JSON_UNESCAPED_UNICODE);

    function getProfileByUserId($userId){
    
        $headers = [
            'Authorization: Bearer ' . getenv("LINE_CHANNEL_ACCESS_TOKEN")
        ];

        try {
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, LINE_GET_PROFILE_URI.$userId);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
            $res = curl_exec($ch);
            curl_close($ch);
        
            $json = json_decode($res, true);
            return $json;
        } catch (Exception $e) {
            http_response_code(404);
        }
    }