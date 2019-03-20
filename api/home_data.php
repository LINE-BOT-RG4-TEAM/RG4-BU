<?php
	require('../utils/db_connector.php');
	/////หาลูกค้า High vale
	$sql_high_value = "SELECT * FROM ca WHERE length(KAMR) <> 0";
	$query_high_value = mysqli_query($conn, $sql_high_value);
	$num_high_value = mysqli_num_rows($query_high_value);
	///////////หาลูกค้าธุรกิจเสิรม
	$sql_bu = "
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
	$query_bu = mysqli_query($conn, $sql_bu);
	$num_bu = mysqli_num_rows($query_bu);
	/////////////////หาลูกค้าที่ไม่เคยซื้อธุรกิจเสริม/////////////
	$sql_not_bu = "
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
					ORDER BY ca.MAX_BILL DESC,ca.kVA_SIZE DESC
					";
	$query_not_bu = mysqli_query($conn,$sql_not_bu);
	$num_not_bu = mysqli_num_rows($query_not_bu);
	//////////////เอาข้อมูลทั้ง 3 ใส่ใน array
	$data = array("high_value"=>$num_high_value,"bu"=>$num_bu,"not_bu"=>$num_not_bu);

	echo json_encode($data);
?>