<?php
  require('../../utils/db_connector.php');

  $fetch_automatic = "
    SELECT ca.CA
          ,ca.BP
          ,bp.CUSTOMER_NAME AS 'BP_NAME'
          ,ca.ADDRESS AS 'CA_ADDRESS'
          ,kW_PK
          ,MAX_BILL
          ,AVG_BILL
          ,kVA_SIZE
          ,COUNT(history.CA) AS 'QUANTITY_PURCHASE'
    FROM crm_bu.ca 
      JOIN crm_bu.bp ON ca.bp = bp.BP
      JOIN crm_bu.history ON ca.CA = history.CA
    GROUP BY ca.CA
            ,ca.BP
            ,bp.CUSTOMER_NAME
            ,ca.ADDRESS
            ,kW_PK
            ,MAX_BILL
            ,AVG_BILL
            ,kVA_SIZE
    ORDER BY COUNT(history.CA) DESC
  ";

  $fetch_automatic_query = $conn->query($fetch_automatic);
  $ca_obj = $fetch_automatic_query->fetch_all(MYSQLI_ASSOC);
  echo json_encode($ca_obj, JSON_UNESCAPED_UNICODE);