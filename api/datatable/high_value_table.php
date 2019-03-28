<?php
  require('../../utils/db_connector.php');

  $fetch_automatic = "
          SELECT bp.CUSTOMER_NAME
          ,ca.CA AS Ca1
          ,history.CA AS Ca2
          ,ca.HML_Type
          ,ca.KAM_TYPE
          ,ca.KAMR
          ,COUNT(history.CA) AS num 
          FROM ca
          LEFT JOIN history
          ON history.CA = ca.CA
          INNER JOIN bp
          ON ca.BP = bp.BP 
          WHERE KAMR IS NOT NULL
          GROUP BY ca.CA
          ORDER BY CASE WHEN ca.KAM_TYPE='strategic' THEN 1 WHEN ca.KAM_TYPE = 'star' THEN 2 WHEN ca.KAM_TYPE = 'status' THEN 3 WHEN ca.KAM_TYPE = 'streamline' THEN 4 END,num DESC,ca.MAX_BILL DESC,ca.kVA_SIZE DESC";

  $fetch_automatic_query = $conn->query($fetch_automatic);
  $ca_obj = $fetch_automatic_query->fetch_all(MYSQLI_ASSOC);
  echo json_encode($ca_obj, JSON_UNESCAPED_UNICODE);