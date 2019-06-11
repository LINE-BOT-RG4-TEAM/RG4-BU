<?php
  require '../vendor/autoload.php'; // If you're using Composer (recommended)
  // Comment out the above line if not using Composer
  // require("<PATH TO>/sendgrid-php.php");
  // If not using Composer, uncomment the above line and
  // download sendgrid-php.zip from the latest release here,
  // replacing <PATH TO> with the path to the sendgrid-php.php file,
  // which is included in the download:
  // https://github.com/sendgrid/sendgrid-php/releases

    // $css_code = include('email-style.css');
    $css_code ='/* CONFIG STYLES Please do not delete and edit CSS styles below */


  /* IMPORTANT THIS STYLES MUST BE ON FINAL EMAIL */
  
  #outlook a {
      padding: 0;
  }
  
  .ExternalClass {
      width: 100%;
  }
  
  .ExternalClass,
  .ExternalClass p,
  .ExternalClass span,
  .ExternalClass font,
  .ExternalClass td,
  .ExternalClass div {
      line-height: 100%;
  }
  
  .es-button {
      mso-style-priority: 100 !important;
      text-decoration: none !important;
  }
  
  a[x-apple-data-detectors] {
      color: inherit !important;
      text-decoration: none !important;
      font-size: inherit !important;
      font-family: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
  }
  
  .es-desk-hidden {
      display: none;
      float: left;
      overflow: hidden;
      width: 0;
      max-height: 0;
      line-height: 0;
      mso-hide: all;
  }
  
  
  /*
  END OF IMPORTANT
  */
  
  html,
  body {
      width: 100%;
      font-family: arial, "helvetica neue", helvetica, sans-serif;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
  }
  
  table {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
      border-collapse: collapse;
      border-spacing: 0px;
  }
  
  table td,
  html,
  body,
  .es-wrapper {
      padding: 0;
      Margin: 0;
  }
  
  .es-content,
  .es-header,
  .es-footer {
      table-layout: fixed !important;
      width: 100%;
  }
  
  img {
      display: block;
      border: 0;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
  }
  
  table tr {
      border-collapse: collapse;
  }
  
  p,
  hr {
      Margin: 0;
  }
  
  h1,
  h2,
  h3,
  h4,
  h5 {
      Margin: 0;
      line-height: 120%;
      mso-line-height-rule: exactly;
      font-family: arial, "helvetica neue", helvetica, sans-serif;
  }
  
  p,
  ul li,
  ol li,
  a {
      -webkit-text-size-adjust: none;
      -ms-text-size-adjust: none;
      mso-line-height-rule: exactly;
  }
  
  .es-left {
      float: left;
  }
  
  .es-right {
      float: right;
  }
  
  .es-p5 {
      padding: 5px;
  }
  
  .es-p5t {
      padding-top: 5px;
  }
  
  .es-p5b {
      padding-bottom: 5px;
  }
  
  .es-p5l {
      padding-left: 5px;
  }
  
  .es-p5r {
      padding-right: 5px;
  }
  
  .es-p10 {
      padding: 10px;
  }
  
  .es-p10t {
      padding-top: 10px;
  }
  
  .es-p10b {
      padding-bottom: 10px;
  }
  
  .es-p10l {
      padding-left: 10px;
  }
  
  .es-p10r {
      padding-right: 10px;
  }
  
  .es-p15 {
      padding: 15px;
  }
  
  .es-p15t {
      padding-top: 15px;
  }
  
  .es-p15b {
      padding-bottom: 15px;
  }
  
  .es-p15l {
      padding-left: 15px;
  }
  
  .es-p15r {
      padding-right: 15px;
  }
  
  .es-p20 {
      padding: 20px;
  }
  
  .es-p20t {
      padding-top: 20px;
  }
  
  .es-p20b {
      padding-bottom: 20px;
  }
  
  .es-p20l {
      padding-left: 20px;
  }
  
  .es-p20r {
      padding-right: 20px;
  }
  
  .es-p25 {
      padding: 25px;
  }
  
  .es-p25t {
      padding-top: 25px;
  }
  
  .es-p25b {
      padding-bottom: 25px;
  }
  
  .es-p25l {
      padding-left: 25px;
  }
  
  .es-p25r {
      padding-right: 25px;
  }
  
  .es-p30 {
      padding: 30px;
  }
  
  .es-p30t {
      padding-top: 30px;
  }
  
  .es-p30b {
      padding-bottom: 30px;
  }
  
  .es-p30l {
      padding-left: 30px;
  }
  
  .es-p30r {
      padding-right: 30px;
  }
  
  .es-p35 {
      padding: 35px;
  }
  
  .es-p35t {
      padding-top: 35px;
  }
  
  .es-p35b {
      padding-bottom: 35px;
  }
  
  .es-p35l {
      padding-left: 35px;
  }
  
  .es-p35r {
      padding-right: 35px;
  }
  
  .es-p40 {
      padding: 40px;
  }
  
  .es-p40t {
      padding-top: 40px;
  }
  
  .es-p40b {
      padding-bottom: 40px;
  }
  
  .es-p40l {
      padding-left: 40px;
  }
  
  .es-p40r {
      padding-right: 40px;
  }
  
  .es-menu td {
      border: 0;
  }
  
  .es-menu td a img {
      display: inline !important;
  }
  
  
  /* END CONFIG STYLES */
  
  a {
      font-family: arial, "helvetica neue", helvetica, sans-serif;
      font-size: 14px;
      text-decoration: underline;
  }
  
  h1 {
      font-size: 30px;
      font-style: normal;
      font-weight: normal;
      color: #333333;
  }
  
  h1 a {
      font-size: 30px;
  }
  
  h2 {
      font-size: 24px;
      font-style: normal;
      font-weight: normal;
      color: #333333;
  }
  
  h2 a {
      font-size: 24px;
  }
  
  h3 {
      font-size: 20px;
      font-style: normal;
      font-weight: normal;
      color: #333333;
  }
  
  h3 a {
      font-size: 20px;
  }
  
  p,
  ul li,
  ol li {
      font-size: 14px;
      font-family: arial, "helvetica neue", helvetica, sans-serif;
      line-height: 150%;
  }
  
  ul li,
  ol li {
      Margin-bottom: 15px;
  }
  
  .es-menu td a {
      text-decoration: none;
      display: block;
  }
  
  .es-wrapper {
      width: 100%;
      height: 100%;
      /* background-image: ; */
      background-repeat: repeat;
      background-position: center top;
  }
  
  .es-wrapper-color {
      background-color: #f6f6f6;
  }
  
  .es-content-body {
      background-color: #ffffff;
  }
  
  .es-content-body p,
  .es-content-body ul li,
  .es-content-body ol li {
      color: #333333;
  }
  
  .es-content-body a {
      color: #2cb543;
  }
  
  .es-header {
      background-color: transparent;
      /* background-image: ; */
      background-repeat: repeat;
      background-position: center top;
  }
  
  .es-header-body {
      background-color: #ffffff;
  }
  
  .es-header-body p,
  .es-header-body ul li,
  .es-header-body ol li {
      color: #333333;
      font-size: 14px;
  }
  
  .es-header-body a {
      color: #1376c8;
      font-size: 14px;
  }
  
  .es-footer {
      background-color: transparent;
      /* background-image: ; */
      background-repeat: repeat;
      background-position: center top;
  }
  
  .es-footer-body {
      background-color: #ffffff;
  }
  
  .es-footer-body p,
  .es-footer-body ul li,
  .es-footer-body ol li {
      color: #333333;
      font-size: 14px;
  }
  
  .es-footer-body a {
      color: #ffffff;
      font-size: 14px;
  }
  
  .es-infoblock,
  .es-infoblock p,
  .es-infoblock ul li,
  .es-infoblock ol li {
      line-height: 120%;
      font-size: 13px;
      color: #cccccc;
  }
  
  .es-infoblock a {
      font-size: 13px;
      color: #cccccc;
  }
  
  a.es-button {
      border-style: solid;
      border-color: #31cb4b;
      border-width: 10px 20px 10px 20px;
      display: inline-block;
      background: #31cb4b;
      border-radius: 30px;
      font-size: 18px;
      font-family: arial, "helvetica neue", helvetica, sans-serif;
      font-weight: normal;
      font-style: normal;
      line-height: 120%;
      color: #ffffff;
      text-decoration: none;
      width: auto;
      text-align: center;
  }
  
  .es-button-border {
      border-style: solid solid solid solid;
      border-color: #2cb543 #2cb543 #2cb543 #2cb543;
      background: #2cb543;
      border-width: 0px 0px 2px 0px;
      display: inline-block;
      border-radius: 30px;
      width: auto;
  }
  
  
  /* RESPONSIVE STYLES Please do not delete and edit CSS styles below. If you don\'t need responsive layout, please delete this section. */
  
  @media only screen and (max-width: 600px) {
      p,
      ul li,
      ol li,
      a {
          font-size: 16px !important;
          line-height: 150% !important;
      }
      h1 {
          font-size: 30px !important;
          text-align: center;
          line-height: 120% !important;
      }
      h2 {
          font-size: 26px !important;
          text-align: center;
          line-height: 120% !important;
      }
      h3 {
          font-size: 20px !important;
          text-align: center;
          line-height: 120% !important;
      }
      h1 a {
          font-size: 30px !important;
      }
      h2 a {
          font-size: 26px !important;
      }
      h3 a {
          font-size: 20px !important;
      }
      .es-menu td a {
          font-size: 16px !important;
      }
      .es-header-body p,
      .es-header-body ul li,
      .es-header-body ol li,
      .es-header-body a {
          font-size: 16px !important;
      }
      .es-footer-body p,
      .es-footer-body ul li,
      .es-footer-body ol li,
      .es-footer-body a {
          font-size: 16px !important;
      }
      .es-infoblock p,
      .es-infoblock ul li,
      .es-infoblock ol li,
      .es-infoblock a {
          font-size: 13px !important;
      }
      *[class="gmail-fix"] {
          display: none !important;
      }
      .es-m-txt-c,
      .es-m-txt-c h1,
      .es-m-txt-c h2,
      .es-m-txt-c h3 {
          text-align: center !important;
      }
      .es-m-txt-r,
      .es-m-txt-r h1,
      .es-m-txt-r h2,
      .es-m-txt-r h3 {
          text-align: right !important;
      }
      .es-m-txt-l,
      .es-m-txt-l h1,
      .es-m-txt-l h2,
      .es-m-txt-l h3 {
          text-align: left !important;
      }
      .es-m-txt-r img,
      .es-m-txt-c img,
      .es-m-txt-l img {
          display: inline !important;
      }
      .es-button-border {
          display: block !important;
      }
      a.es-button {
          font-size: 20px !important;
          display: block !important;
          border-width: 10px 0px 10px 0px !important;
      }
      .es-btn-fw {
          border-width: 10px 0px !important;
          text-align: center !important;
      }
      .es-adaptive table,
      .es-btn-fw,
      .es-btn-fw-brdr,
      .es-left,
      .es-right {
          width: 100% !important;
      }
      .es-content table,
      .es-header table,
      .es-footer table,
      .es-content,
      .es-footer,
      .es-header {
          width: 100% !important;
          max-width: 600px !important;
      }
      .es-adapt-td {
          display: block !important;
          width: 100% !important;
      }
      .adapt-img {
          width: 100% !important;
          height: auto !important;
      }
      .es-m-p0 {
          padding: 0px !important;
      }
      .es-m-p0r {
          padding-right: 0px !important;
      }
      .es-m-p0l {
          padding-left: 0px !important;
      }
      .es-m-p0t {
          padding-top: 0px !important;
      }
      .es-m-p0b {
          padding-bottom: 0 !important;
      }
      .es-m-p20b {
          padding-bottom: 20px !important;
      }
      .es-mobile-hidden,
      .es-hidden {
          display: none !important;
      }
      .es-desk-hidden {
          display: table-row!important;
          width: auto!important;
          overflow: visible!important;
          float: none!important;
          max-height: inherit!important;
          line-height: inherit!important;
      }
      .es-desk-menu-hidden {
          display: table-cell!important;
      }
      table.es-table-not-adapt,
      .esd-block-html table {
          width: auto !important;
      }
      table.es-social {
          display: inline-block !important;
      }
      table.es-social td {
          display: inline-block !important;
      }
  }
  
  
  /* END RESPONSIVE STYLES */
  ';

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
      '.$css_code.'
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
                                                                                        <h2>เอกสารหลักฐานการสั่งซื้อบริการเสริมจาก กฟภ.</h2>
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
                                                                                        <h4><strong>ข้อมูลการสั่งซื้อ</strong></h4>
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
                                                    <td class="esd-structure es-p10t es-p10b es-p20r es-p20l" align="left">
                                                        <!--[if mso]><table width="560" cellpadding="0"
                            cellspacing="0"><tr><td width="160" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="160" class="es-m-p0r es-m-p20b esd-container-frame" valign="top" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="right" class="esd-block-text">
                                                                                        <p><strong>หมายเลขคำสั่งซื้อ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="right" class="esd-block-text">
                                                                                        <p><strong>ชื่อธุรกิจ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="right" class="esd-block-text">
                                                                                        <p><strong>ผู้สั่งซื้อ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="right" class="esd-block-text">
                                                                                        <p><strong>ที่อยู่ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="right" class="esd-block-text">
                                                                                        <p><strong>เบอร์โทรศัพท์ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="right" class="esd-block-text">
                                                                                        <p><strong>อีเมลล์ :&nbsp;</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="10"></td><td width="390" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="390" align="left" class="esd-container-frame" esdev-config="h3">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p>PO00009</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p>ที่ทำการองค์การบริหารส่วนตำบลบางรัก</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p>นายการไฟฟ้า ส่วนภูมิภาค</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p>201 ม.4 ต.บางรัก อ.เมืองตรัง จ.ตรัง 92000</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p>0898786733</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p>kanfaifa.suan@gmail.com</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
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
                                                                                        <h4><strong>บริการเสริมที่ท่านสนใจ</strong></h4>
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
                                                                                                <tr>
                                                                                                    <td style="text-align: center;">1</td>
                                                                                                    <td style="text-align: left;">MP3100 - ตรวจสอบหาความร้อนของจุดต่ออุปกรณ์ระบบไฟฟ้า</td>
                                                                                                    <td style="text-align: center;">2019-09-01</td>
                                                                                                    <td>อยากทราบข้อมูลเพิ่มเติมมากกว่านี้</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td style="text-align: center;">2</td>
                                                                                                    <td style="text-align: left;">MP3200 - ตรวจสอบระบบและอุปกรณ์ไฟฟ้าสำหรับลูกค้า</td>
                                                                                                    <td style="text-align: center;">2019-08-04</td>
                                                                                                    <td>บริการนี้มีค่าใช้จ่ายเท่าไหร่ค่ะ</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td style="text-align: center;">3</td>
                                                                                                    <td style="text-align: left;">MP3400 - งานบริหารจัดการการใช้พลังงานไฟฟ้าอย่างมีประสิทธิภาพ</td>
                                                                                                    <td style="text-align: center;">2019-05-04</td>
                                                                                                    <td>ต้องการให้พนักงงานการไฟฟ้า เข้ามาตรวจสอบพื้นที่หน้างานก่อนนะคะ</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td style="text-align: center;">4</td>
                                                                                                    <td style="text-align: left;">MP1101 - สายส่งระบบแรงดัน 115kV (เหนือดิน/ใต้ดิน)</td>
                                                                                                    <td style="text-align: center;">2019-06-03</td>
                                                                                                    <td>ไม่มีความประสงค์เพิ่มเติม</td>
                                                                                                </tr>
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
                                                                                        <p>Text</p>
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
                                                    <td class="esd-structure es-p20t es-p15b es-p20r es-p20l" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <p>Text</p>
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

  $purchase_id = $_GET['purchase_id'];

  $email = new \SendGrid\Mail\Mail(); 
  $email->setFrom("crm_bu@pea.co.th", "Support PEA SmartBiz");
  $email->setSubject("คำสั่งซื้อ $purchase_id - เอกสารหลักฐานการสั่งซื้อบริการเสริมจาก กฟภ.");
  $email->addTo("mean.mea2@gmail.com", "Cheevavorn Saitthakool");
//   $email->addTo("chiwawon.sae@pea.co.th", "chiwawon saetakul");
  $email->addContent(
      "text/html", $html_template
  );
  $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
  try {
      $response = $sendgrid->send($email);
      echo "<pre>";
      var_dump($response);
      echo "</pre>";
    //   print $response->statusCode() . "\n";
    //   print_r($response->headers());
    //   print $response->body() . "\n";
  } catch (Exception $e) {
      echo 'Caught exception: '. $e->getMessage() ."\n";
  }
