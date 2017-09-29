<?php
function __autoload($class_name) {
    include_once 'class/'.$class_name.'.php';
}
$dbh=new dbPDO_mng();
$read="connection/conn_DB.txt";
$dbh->para_read($read);
$dbh->conn_PDO();
$takerisk_id = $_GET['takerisk_id'];
$sql = "select t1.hn,t1.an,t1.take_other,t1.take_date,t1.take_time2,t1.take_rec_date
,t1.level_risk,t1.take_detail,t1.take_first,t1.take_counsel,d1.name as department_name 
,p1.name as place_name,c1.name as category_name,s1.name as subcategory_name  
from takerisk t1
LEFT OUTER JOIN department d1 ON d1.dep_id=t1.res_dep
LEFT OUTER JOIN place p1 ON p1.place=t1.take_place
LEFT OUTER JOIN category c1 ON c1.category=t1.category
LEFT OUTER JOIN user u1 ON u1.user_id=t1.user_id
LEFT OUTER JOIN subcategory s1 ON s1.subcategory=t1.subcategory
where t1.takerisk_id=".$takerisk_id."";

$dbh->imp_sql($sql);
$result=$dbh->select_a();

if ($result) {
        echo $result["hn"].",".$result["an"].",".$result["take_other"].",".$result["take_date"].",".$result["take_time2"]
        .",".$result["take_rec_date"].",".$result["place_name"].",".$result["department_name"].",".$result["category_name"]
        .",".$result["subcategory_name"].",".$result["level_risk"].",".$result["take_detail"].",".$result["take_first"]
        .",".$result["take_counsel"];
}else{
	echo "false";
    //exit();
}

?>
