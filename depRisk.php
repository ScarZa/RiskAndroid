<?php
function __autoload($class_name) {
    include_once 'class/'.$class_name.'.php';
}
$dbh=new dbPDO_mng();
$read="connection/conn_DB.txt";
$dbh->para_read($read);
$dbh->conn_PDO();
$sql = "select  t1.takerisk_id,t1.level_risk,LEFT(s1.`name`,30) AS detail  from   takerisk t1
inner join subcategory s1 on t1.subcategory=s1.subcategory
INNER JOIN mngrisk m1 ON m1.takerisk_id=t1.takerisk_id
Where t1.recycle='N' and  t1.res_dep='1' and t1.move_status='N' AND m1.mng_status='N' ORDER BY t1.takerisk_id DESC";

$dbh->imp_sql($sql);
$result=$dbh->select();

if ($result) {
   // print_r($result);
   //echo "{";
    for($i=0;$i<count($result);$i++){
        echo $result[$i]["takerisk_id"].":".$result[$i]["level_risk"].":".$result[$i]["detail"];
        if($i<(count($result)-1)){
            echo ",";
        }
    }
    //echo "}";
}else{
	echo "false";
    //exit();
}

?>
