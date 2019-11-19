<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once './utils/db_connector.php';

    $queryString = $_SERVER['QUERY_STRING'];
    if(!isset($queryString) || empty($queryString)){
        die("ไม่สามารถเรียกดูเอกสารหลักฐานได้เนื่องจากท่านเรียกดูด้วยวิธีการที่ไม่ถูกต้อง");
    }

    parse_str(base64_decode($queryString), $params);
    if(empty(array_filter($params))) {
        die("ไม่พบใบสรุปความต้องการของท่าน, กรุณาลองใหม่อีกครั้ง");
    }
    $purchase_id = $params['purchase_id'];

    // ดึงข้อมูลทั่วไปมาแสดงบริเวณ Header
    $fetch_general_data = "
        SELECT bp.BP
                , bp.CUSTOMER_NAME
                , ca.PEA_CODE
                , ADDRESS
                , purchase.FullName
                , purchase.CA_TEL
                , purchase.CA_EMAIL
                , purchase.UserID
                , office.TEL_CONTACT
                , office.PEA_NAME
        FROM purchase 
            JOIN ca ON ca.UserID = purchase.UserID
            JOIN bp ON ca.bp = bp.BP
            JOIN office ON ca.PEA_CODE = office.PEA_CODE
        WHERE purchase.purchase_id = '$purchase_id';
    ";
    $general_results = $conn->query($fetch_general_data);
    $row = $general_results->fetch_assoc();

    // ดึงรายการสินค้าบริการต่างๆ ที่ได้รับ อ้างอิงจาก purchase id
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

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8', 
        'orientation' => 'P',
        'default_font' => 'sarabun',
        'setAutoBottomMargin' => 'pad'
    ]);
    
    // set watermarks
    $wm = ("การไฟฟ้าส่วนภูมิภาค - กฟภ.");
    $mpdf->SetWatermarkText($wm, 0.1);
    $mpdf->showWatermarkText = true;

    // set title and author
    $current_date = date("Y-m-d");
    $mpdf->SetTitle("$current_date-ใบสรุปความต้องการ-$purchase_id");
    $mpdf->SetAuthor("Automated report by PEA SmartBiz");

    $mpdf->SetHTMLHeader('
        <div style="text-align: right; font-weight: bold;">
            การไฟฟ้าส่วนภูมิภาค
        </div>
    ');

    $mpdf->SetHTMLFooter('
    <table width="100%" border="0">
        <tr>
            <td width="33%">
                <img src="./assets/images/qr-code-with-logo.png" width="100" /><br/>
                ระบบอัตโนมัติสร้างเอกสารนี้เมื่อวันที่ {DATE j-m-Y}
            </td>
            <td width="33%" align="center" style="vertical-align: bottom;">หน้าที่ {PAGENO} จากทั้งหมด {nbpg} หน้า</td>
            <td width="33%" style="text-align: right;vertical-align: bottom;">ใบสรุปความต้องการ เลขที่ '.$purchase_id.'</td>
        </tr>
    </table>');
    $body_page = "
        <style>
            table.customTable {
                width: 100%;
                background-color: #FFFFFF;
                border-collapse: collapse;
                border-width: 2px;
                border-color: #D1D1D1;
                border-style: solid;
                color: #000000;
            }

            table.customTable td, table.customTable th {
                border-width: 2px;
                border-color: #D1D1D1;
                border-style: solid;
                padding: 5px;
            }

            table.customTable thead {
                background-color: #D1D1D1;
            }
        </style>
    ";
    $body_page .= '
        <div>
            <img src="./assets/images/pea-logo.png" style="width:170px;margin: 0;padding-bottom:0px;" />
            <h1 style="font-size: 40px;font-family: printable4u;">ใบสรุปความต้องการบริการเสริม</h1>
            <h2 style="font-size: 30px;font-family: printable4u;">ข้อมูลทั่วไป</h2>
        </div>
        <div>
            <table border="0" style="width:100%;height:100%;table-layout:fixed;overflow:hidden">
                <tr>
                    <td style="font-size:24px;width:12%;text-align:right;font-weight:bold;">
                        ใบสรุปฯ เลขที่:
                    </td>
                    <td style="font-size:22px;width:16%;padding-left:10px;border: 1px solid #E8E8E8;">
                        '.$purchase_id.'
                    </td>
                    <td style="font-size:24px;width:10%;text-align:right;font-weight:bold;">
                        ชื่อธุรกิจ:
                    </td>
                    <td style="font-size:20px;width:28%;padding-left:10px;border: 1px solid #E8E8E8;">
                        '.$row['CUSTOMER_NAME'].'
                    </td>
                </tr>
                <tr>
                    <td style="font-size:24px;width:14%;text-align:right;font-weight:bold;">
                        ผู้ติดต่อ:
                    </td>
                    <td colspan="3" style="font-size:20px;width:26%;padding-left:10px;border: 1px solid #E8E8E8;">
                        '.$row['FullName'].'
                    </td>
                </tr>
                <tr>
                    <td style="font-size:24px;width:14%;text-align:right;font-weight:bold;">
                        ที่อยู่:
                    </td>
                    <td colspan="3" style="font-size:20px;width:26%;padding-left:10px;border: 1px solid #E8E8E8;">
                        '.$row['ADDRESS'].'
                    </td>
                </tr>
                <tr>
                    <td style="font-size:24px;width:12%;text-align:right;font-weight:bold;">
                        เบอร์โทรศัพท์:
                    </td>
                    <td style="font-size:22px;width:16%;padding-left:10px;border: 1px solid #E8E8E8;">
                        '.$row['CA_TEL'].'
                    </td>
                    <td style="font-size:24px;width:10%;text-align:right;font-weight:bold;">
                        อีเมล์:
                    </td>
                    <td style="font-size:20px;width:28%;padding-left:10px;border: 1px solid #E8E8E8;">
                        '.$row['CA_EMAIL'].'
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <h2 style="font-size: 30px;font-family: printable4u;">บริการเสริมที่ท่านสนใจ</h2>
            <table class="customTable" style="width:100%;height:100%;table-layout:fixed;overflow:hidden">
                <thead align="center">
                    <tr style="background-color: black;">
                        <th style="font-weight:bold;font-size:22px;color:white;">ลำดับ</th>
                        <th style="font-weight:bold;font-size:22px;color:white;">บริการ</th>
                        <th style="font-weight:bold;font-size:22px;color:white;">วันนัดหมาย</th>
                        <th style="font-weight:bold;font-size:22px;color:white;">ความประสงค์เพิ่มเติม</th>
                    </tr>
                </thead>
                <tbody>
        ';
        $i = 1;
        while($lineitem = $lineitem_results->fetch_assoc()){
            $body_page .= '
                        <tr>
                            <td style="font-size:19px;" align="center">'.($i++).'</td>
                            <td style="font-size:17px;white-space:nowrap;">'.$lineitem['cate_id'].' - '.$lineitem['cate_name'].'</td>
                            <td align="center" style="font-size:19px;">'.$lineitem['appointment_date'].'</td>
                            <td style="font-size:19px;">'.$lineitem['description'].'</td>
                        </tr>
                        ';
        }

        $tel_contact = $row["TEL_CONTACT"];
        $tel_contact_template = "";
        if(!is_null($tel_contact)){
            $pea_name = $row["PEA_NAME"];
            $tel_contact_template .= "<li>
                ท่านสามารถติดต่อพนักงานของ {$pea_name} ผ่านโทรศัพท์หมายเลข {$tel_contact}
            </li>";
        }
        
        $body_page .= '        </tbody>
            </table>
        </div>
        <div>
            <h3 style="font-family:printable4u;font-size:24px;">หมายเหตุ</h3>
            <ul style="font-size:20px;">
                <li>
                    ทาง กฟภ. ได้รับความต้องการของท่านเรียบร้อยแล้ว หากมีข้อมูลไม่ถูกต้อง เช่น ชื่อ-สกุล, เบอร์โทรศัพท์, อีเมล์ หรือที่อยู่ ท่านสามารถแก้ไขได้ทันที ผ่าน LINE Account "PEA SmartBiz" หรือ QR Code บริเวณมุมล่างซ้ายค่ะ
                </li>
                '.$tel_contact_template.'
            </ul>
        </div>
    ';
    $mpdf->WriteHTML($body_page);
    $mpdf->Output();