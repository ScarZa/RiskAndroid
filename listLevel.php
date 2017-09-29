<?php
function __autoload($class_name) {
    include_once 'class/'.$class_name.'.php';
}
$dbh=new dbPDO_mng();
$read="connection/conn_DB.txt";
$dbh->para_read($read);
$dbh->conn_PDO();
$sql = "SELECT level_risk FROM level_risk";

$dbh->imp_sql($sql);
$result=$dbh->select();

if ($result) {
    for($i=0;$i<count($result);$i++){
        echo $result[$i]["level_risk"];
        if($i<(count($result)-1)){
            echo ",";
        }
    }
}else{
	echo "false";
}

?>
