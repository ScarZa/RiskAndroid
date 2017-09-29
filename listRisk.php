<?php
function __autoload($class_name) {
    include_once 'class/'.$class_name.'.php';
}
$dbh=new dbPDO_mng();
$read="connection/conn_DB.txt";
$dbh->para_read($read);
$dbh->conn_PDO();
$sql = "SELECT * FROM subcategory ORDER BY category ASC,subcategory ASC";

$dbh->imp_sql($sql);
$result=$dbh->select();

if ($result) {
   // print_r($result);
    for($i=0;$i<count($result);$i++){
        echo $result[$i]["category"].":".$result[$i]["subcategory"].":".$result[$i]["name"]."\r\n";
    }
}else{
	echo "false";
    //exit();
}

?>
