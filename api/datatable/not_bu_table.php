<?php
  require('../../utils/db_connector.php');

  $fetch_automatic = "
  SELECT ca.CA
			,bp.CUSTOMER_NAME
			,ca.MAX_BILL
			,ca.kVA_SIZE 
FROM history
RIGHT JOIN ca
ON history.CA = ca.CA
INNER JOIN bp
ON ca.BP = bp.BP
WHERE history.CA IS NULL AND LENGTH(ca.KAMR) = 0
ORDER BY ca.MAX_BILL DESC,ca.kVA_SIZE DESC ";

  $fetch_automatic_query = $conn->query($fetch_automatic);
  $ca_obj = $fetch_automatic_query->fetch_all(MYSQLI_ASSOC);
  echo json_encode($ca_obj, JSON_UNESCAPED_UNICODE);