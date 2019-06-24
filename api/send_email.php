<?php
    date_default_timezone_set("Asia/Bangkok");
    require("../vendor/autoload.php"); 
    require("../utils/db_connector.php"); 
    require("../utils/date_utils.php");

    if(!isset($_GET['purchase_id']) && !array_key_exists("purchase_id", $_GET)){
        http_response_code(403);
        die("ไม่สามารถส่งอีเมล์ เนื่องจากไม่มีเลขที่คำสั่งซื้อ");
    }

    ob_start();
    $purchase_id = $_GET['purchase_id'];

    // fetch purchase header detail
    $fetch_general_data = "
        SELECT bp.BP
                , bp.CUSTOMER_NAME
                , ca.PEA_CODE
                , ADDRESS
                , FullName
                , CA_TEL
                , CA_EMAIL
                , purchase.UserID
        FROM purchase 
            JOIN ca ON ca.UserID = purchase.UserID
            JOIN bp ON ca.bp = bp.BP
        WHERE purchase_id = '$purchase_id';
    ";
    $general_results = $conn->query($fetch_general_data);
    $general_row = $general_results->fetch_assoc();

    // fetch service detail
    $fetch_lineitem = "
        SELECT lineitem.cate_id
            , cate_name
            , CASE
                WHEN LENGTH(des) = 0 THEN '--ท่านไม่มีความประสงค์เพิ่มเติม--'
                ELSE des
            END AS `description`
            , lineitem.appointment_date
        FROM purchase_lineitem lineitem
            JOIN product_category category ON lineitem.cate_id = category.cate_id
        WHERE lineitem.purchase_id = '$purchase_id';
    ";
    $lineitem_results = $conn->query($fetch_lineitem);
    $i = 1;
    $service_body = "";
    while($row = $lineitem_results->fetch_assoc()){
        $service_body .= '
            <tr>
                <td style="text-align: center;">'.($i++).'</td>
                <td style="text-align: left;">'.$row['cate_id'].' - '.$row['cate_name'].'</td>
                <td style="text-align: center;">'.dateThai($row['appointment_date']).'</td>
                <!-- <td>'.$row['description'].'</td> -->
            </tr>
        ';
    }

    $css_contents = file_get_contents('../assets/css/email-style.css');
    include "../assets/templates/email/email_template.php";
    $html_template = ob_get_clean();

    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("crm_bu@pea.co.th", "Support PEA SmartBiz");
    $email->setSubject("[คำสั่งซื้อ $purchase_id] เอกสารหลักฐานการสั่งซื้อบริการเสริมจาก กฟภ.");
    $email->addTo($general_row['CA_EMAIL'], $general_row['FullName']);
    $email->addContent(
        "text/html", $html_template
    );
    
    $sendgrid = new \SendGrid(getenv("PROD_SENDGRID_API_KEY"));
    try {
        $response = $sendgrid->send($email);

        $return_json = array(
            'status' => $response->statusCode(),
            'message' => $response->headers()[2]
        );
        http_response_code($response->statusCode());
        // print_r(json_encode($return_json));
        var_dump($response);
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
