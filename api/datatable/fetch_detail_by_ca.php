

<?php
  require('../../utils/db_connector.php');

  if(!array_key_exists("ca", $_GET) 
      || (is_null($_GET['ca']) 
      || empty($_GET['ca']))){
    echo "ท่านเข้าดูรายละเอียดลูกค้าไม่ถูกต้อง เนื่องจากไม่มีข้อมูล CA";
    exit(0);
  }

  $fetch_ca_detail = "
    SELECT bp.BP
          , ca.CA
          , bp.CUSTOMER_NAME
          , BUSINESS_TYPE
          , ca.ADDRESS
          , ca.TEL
          , ca.HML_Type
          , ca.MAX_BILL
          , KAM_TYPE
          , KAMR
    FROM ca 
    JOIN bp ON ca.BP = bp.BP
    WHERE ca.CA = ?
  ";

  $stmt = $conn->prepare($fetch_ca_detail);
  $stmt->bind_param("i", $_GET['ca']);
  $stmt->execute();
  $result = $stmt->get_result();
  $ca_detail = $result->fetch_assoc();

  echo json_encode($ca_detail, JSON_UNESCAPED_UNICODE);