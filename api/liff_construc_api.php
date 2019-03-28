<?php
require('../utils/db_connector.php');
$data =array();
$data1 = array();
$cate_id = $_GET["cate_id"];
/////////
$sql_level_1 = "SELECT * FROM product_category WHERE cate_id = '$cate_id'";
$query_level_1 = mysqli_query($conn,$sql_level_1);
$obj_level = mysqli_fetch_assoc($query_level_1);
$data1 = array("level"=>$obj_level);
array_push($data,$obj_level);
/////////
$sql_cate_id = "SELECT * FROM product_category WHERE parent_cate_id = '$cate_id'";
$query_cate_id = mysqli_query($conn,$sql_cate_id);

while($obj = mysqli_fetch_assoc($query_cate_id))
{
    array_push($data,$obj);
}
echo json_encode($data);

?>