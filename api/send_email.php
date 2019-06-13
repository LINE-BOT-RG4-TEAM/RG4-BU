<?php
    date_default_timezone_set("Asia/Bangkok");
    require("../vendor/autoload.php"); 
    require("../utils/db_connector.php"); 

    if(!isset($_GET['purchase_id']) && !array_key_exists("purchase_id", $_GET)){
        http_response_code(403);
        die("ไม่สามารถส่งอีเมล์ เนื่องจากไม่มีเลขที่คำสั่งซื้อ");
    }

    $css_contents = file_get_contents('../assets/css/email-style.css');
    $purchase_id = $_GET['purchase_id'];

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

    $html_template = '
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html>
  <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1" name="viewport">
      <meta name="x-apple-disable-message-reformatting">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="telephone=no" name="format-detection">
      <title></title>
      <!--[if (mso 16)]>
      <style type="text/css">
      a {text-decoration: none;}
      </style>
      <![endif]-->
      <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
      <style>
      '.$css_contents.'
      </style>
  </head>
  
  <body>
    <div class="es-wrapper-color">
        <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#f6f6f6"></v:fill>
			</v:background>
		<![endif]-->
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="esd-email-paddings" valign="top">
                        <table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p10" style="background-color: rgb(255, 255, 255);" bgcolor="#ffffff" align="left" esd-custom-block-id="14318">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="580" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-image" align="center">
                                                                                        <a href target="_blank"><img src="https://afmwb.stripocdn.email/content/guids/CABINET_60960b04913164f15a16e95e63c855bc/images/35161560135436824.gif" alt width="130" style="display: block;"></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure" esd-general-paddings-checked="false" align="left" esd-custom-block-id="14352">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="600" valign="top" align="center" esd-custom-block-id="14353">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-text" align="center">
                                                                                        <p><br></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-text" align="center">
                                                                                        <h3 style="font-weight: bold;">เอกสารหลักฐานการสั่งซื้อบริการเสริมจาก กฟภ.</h3>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-spacer es-p10t es-p20r es-p20l" align="center">
                                                                                        <table style="width: 90% !important;" width="90%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="border-bottom: 2px solid rgb(191, 144, 0); background: none; height: 1px; width: 100%; margin: 0px;"></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <h4 style="font-size:24px;"><strong>ข้อมูลการสั่งซื้อ</strong></h4>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- header section -->
                                                <tr>
                                                    <td class="esd-structure es-p10t es-p10b es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="es-m-p0r esd-container-frame" valign="top" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p style="font-size:20px;"><strong>หมายเลขคำสั่งซื้อ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" style="border: 1px solid black;padding: 2px 2px 2px 2px;" class="esd-block-text">
                                                                                        <p style="font-size:20px;">'.$purchase_id.'</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p style="margin-top:15px;font-size:20px;"><strong>ชื่อธุรกิจ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" style="border: 1px solid black;padding: 2px 2px 2px 2px;" class="esd-block-text">
                                                                                        <p style="font-size:16px;">'.$general_row['CUSTOMER_NAME'].'</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p style="margin-top:15px;font-size:20px;"><strong>ผู้สั่งซื้อ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" style="border: 1px solid black;padding: 2px 2px 2px 2px;" class="esd-block-text">
                                                                                        <p style="font-size:16px;">'.$general_row['FullName'].'</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p style="margin-top:15px;font-size:20px;"><strong>ที่อยู่ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" style="border: 1px solid black;padding: 2px 2px 2px 2px;" class="esd-block-text">
                                                                                        <p style="font-size:16px;">'.$general_row['ADDRESS'].'</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p style="margin-top:15px;font-size:20px;"><strong>เบอร์โทรศัพท์ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" style="border: 1px solid black;padding: 2px 2px 2px 2px;" class="esd-block-text">
                                                                                        <p style="font-size:16px;">'.$general_row['CA_TEL'].'</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p style="margin-top:15px;font-size:20px;"><strong>อีเมล :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" style="border: 1px solid black;padding: 2px 2px 2px 2px;" class="esd-block-text">
                                                                                        <p style="font-size:16px;">'.$general_row['CA_EMAIL'].'</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <!-- end of header section -->
                                                <tr>
                                                    <td class="esd-structure es-p10t es-p20r es-p20l" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <h4 style="font-size:24px;"><strong>บริการเสริมที่ท่านสนใจ</strong></h4>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p5t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text">
                                                                                        <p style="line-height: 120%;"><br></p>
                                                                                        <table border="1" cellspacing="1" cellpadding="1" style="width:500px;">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th scope="col">ลำดับ</th>
                                                                                                    <th scope="col">บริการ</th>
                                                                                                    <th scope="col" style="width:18%;">วันนัดหมาย</th>
                                                                                                    <th scope="col">หมายเหตุ</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
    ';

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
    while($row = $lineitem_results->fetch_assoc()){
        $html_template .= '
            <tr>
                <td style="text-align: center;">'.($i++).'</td>
                <td style="text-align: left;">'.$row['cate_id'].' - '.$row['cate_name'].'</td>
                <td style="text-align: center;">'.$row['appointment_date'].'</td>
                <td>'.$row['description'].'</td>
            </tr>
        ';
    }
    $html_template .= '
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <p style="line-height: 120%;"><br></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p10t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <h4>หมายเหตุ</h4>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure esdev-adapt-off es-p10t es-p10b es-p20r es-p20l" align="left">
                                                        <table cellspacing="0" cellpadding="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="560" align="left">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p>อีเมล์ฉบับนี้ส่งโดยระบบอัตโนมัติ เพื่อเป็นหลักฐานยืนยันการสั่งซื้อบริการเสริมจากแอพพลิเคชั่น PEA SmartBiz</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content esd-footer-popover" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" esd-custom-block-id="14372" align="center">
                                        <table class="es-footer-body" style="background-color: rgb(51, 51, 51);" width="600" cellspacing="0" cellpadding="0" bgcolor="#333333" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p style="font-weight: bold;color:white;">อีเมล์ส่งเมื่อ '.date('วันที่ Y/m/d เวลา h:i:sa').'</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
  
  </html>
  
  ';

  $email = new \SendGrid\Mail\Mail(); 
  $email->setFrom("crm_bu@pea.co.th", "Support PEA SmartBiz");
  $email->setSubject("[คำสั่งซื้อ $purchase_id] เอกสารหลักฐานการสั่งซื้อบริการเสริมจาก กฟภ.");
  $email->addTo($general_row['CA_EMAIL'], $general_row['FullName']);
  $email->addContent(
      "text/html", $html_template
  );
  $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
  try {
      $response = $sendgrid->send($email);
      echo "<pre>";
      var_dump($response);
      echo "</pre>";

      echo "<pre>";
      print $response->statusCode() . "\n";
      echo "</pre>";

      echo "<pre>";
      print_r($response->headers());
      echo "</pre>";

      echo "<pre>";
      print_r($response->body());
      echo "</pre>";
  } catch (Exception $e) {
      echo 'Caught exception: '. $e->getMessage() ."\n";
  }
