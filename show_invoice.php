<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once './utils/db_connector.php';

    $queryString = $_SERVER['QUERY_STRING'];
    parse_str(base64_decode($queryString), $params);

    $purchase_id = $params['purchase_id'];

    // $conn->query

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8', 
        'orientation' => 'P',
        'default_font' => 'sarabun'
    ]);

    $current_date = date("Y-m-d");
    $mpdf->SetTitle("$current_date-เอกสารหลักฐานการสั่งซื้อ-$purchase_id");
    $mpdf->SetAuthor("Automated report by SmartBiz");

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
                สร้างรายงานเมื่อ {DATE j-m-Y}
            </td>
            <td width="33%" align="center" style="vertical-align: bottom;">หน้าที่ {PAGENO} จากทั้งหมด {nbpg} หน้า</td>
            <td width="33%" style="text-align: right;vertical-align: bottom;">การไฟฟ้าส่วนภูมิภาค</td>
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
            <h1 style="font-size: 40px;font-family: printable4u;">เอกสารหลักฐานการสั่งซื้อบริการเสริมจาก กฟภ.</h1>
            <h2 style="font-size: 30px;font-family: printable4u;">ข้อมูลทั่วไป</h2>
        </div>
        <div>
            <table border="0" style="width:100%;height:100%;table-layout:fixed;overflow:hidden">
                <tr>
                    <td style="font-size:24px;width:12%;text-align:right;font-weight:bold;">
                        หมายเลขคำสั่งซื้อ:
                    </td>
                    <td style="font-size:22px;width:16%;padding-left:10px;border: 1px solid #E8E8E8;">
                        #'.$purchase_id.'
                    </td>
                    <td style="font-size:24px;width:10%;text-align:right;font-weight:bold;">
                        ชื่อธุรกิจ:
                    </td>
                    <td style="font-size:20px;width:28%;padding-left:10px;border: 1px solid #E8E8E8;">
                        บริษัท ซีพี จำกัด มหาชน
                    </td>
                </tr>
                <tr>
                    <td style="font-size:24px;width:14%;text-align:right;font-weight:bold;">
                        ผู้สั่งซื้อ:
                    </td>
                    <td colspan="3" style="font-size:20px;width:26%;padding-left:10px;border: 1px solid #E8E8E8;">
                        นายชีววร เศรษฐกุล
                    </td>
                </tr>
                <tr>
                    <td style="font-size:24px;width:14%;text-align:right;font-weight:bold;">
                        ที่อยู่:
                    </td>
                    <td colspan="3" style="font-size:20px;width:26%;padding-left:10px;border: 1px solid #E8E8E8;">
                        200 ถนนงามวงศ์วาน ลาดยาว จตุจักร กรุงเทพ 10900
                    </td>
                </tr>
                <tr>
                    <td style="font-size:24px;width:12%;text-align:right;font-weight:bold;">
                        เบอร์โทรศัพท์:
                    </td>
                    <td style="font-size:22px;width:16%;padding-left:10px;border: 1px solid #E8E8E8;">
                        089-724-5303
                    </td>
                    <td style="font-size:24px;width:10%;text-align:right;font-weight:bold;">
                        อีเมล์:
                    </td>
                    <td style="font-size:20px;width:28%;padding-left:10px;border: 1px solid #E8E8E8;">
                        mean.mea2@gmail.com
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
                        <th style="font-weight:bold;font-size:22px;color:white;">หมายเหตุ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-size:19px;" align="center">1</td>
                        <td style="font-size:19px;white-space:nowrap;">M1301 - ทดสอบบริการ ทดสอบบริการ</td>
                        <td align="center" style="font-size:19px;">3 พ.ย. 2562</td>
                        <td style="font-size:19px;">กรุณาเข้ามาตรวจสอบในบริเวณโรงงานด้วยครับ</td>
                    </tr>
                    <tr>
                        <td style="font-size:19px;" align="center">2</td>
                        <td style="font-size:19px;white-space:nowrap;">M1302 - ทดสอบบริการ ทดสอบบริการ</td>
                        <td align="center" style="font-size:19px;">3 พ.ย. 2562</td>
                        <td style="font-size:19px;">กรุณาเข้ามาตรวจสอบในบริเวณโรงงานด้วยครับ</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <h3 style="font-family:printable4u;font-size:24px;">หมายเหตุ</h3>
            <ul style="font-size:20px;">
                <li>
                    ทาง กฟภ. ได้รับความต้องการของท่านเรียบร้อยแล้ว หากมีข้อมูลไม่ถูกต้อง ท่านสามารถแก้ไขได้ทันที ผ่าน LINE Account "PEA SmartBiz" หรือ QR Code บริเวณมุมล่างซ้ายค่ะ
                </li>
            </ul>
        </div>
    ';
    $mpdf->WriteHTML($body_page);
    $mpdf->Output();