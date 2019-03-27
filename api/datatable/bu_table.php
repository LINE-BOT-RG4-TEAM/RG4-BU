<?php
  require('../../utils/db_connector.php');

  $fetch_automatic = "
                        SELECT ca.CA
				,bp.CUSTOMER_NAME
				,COUNT(history.CA) AS num
				,ca.kVA_SIZE,ROUND(sum(history.PAYMENT),2) AS paid
				,ca.MAX_BILL
				,MAX(history.HISTORY) AS last
                        FROM ca
                        INNER JOIN bp
                        ON ca.BP = bp.BP
                        INNER JOIN history 
                        ON history.CA = ca.CA
                        WHERE LENGTH(ca.KAMR) = 0
                        GROUP BY history.CA
                        ORDER BY ca.MAX_BILL DESC,ca.kVA_SIZE DESC,num DESC";

  $fetch_automatic_query = $conn->query($fetch_automatic);
  $ca_obj = $fetch_automatic_query->fetch_all(MYSQLI_ASSOC);
  echo json_encode($ca_obj, JSON_UNESCAPED_UNICODE);