<?php
//include_once 'connection/connect.php';
function __autoload($class_name) {
    include_once 'class/'.$class_name.'.php';
}


                $userID = isset($_POST['userID'])?$_POST['userID']:'';
                $userName = isset($_POST['userName'])?$_POST['userName']:'';
                $userDep = isset($_POST['userDep'])?$_POST['userDep']:'';
                $userMDep = isset($_POST['userMDep'])?$_POST['userMDep']:'';
                $userStatus = isset($_POST['userStatus'])?$_POST['userStatus']:'';
                $takerisk_id = isset($_POST['takerisk_id'])?$_POST['takerisk_id']:'';
                $return_date=date("Y-m-d");
// using PDO

$dbh=new dbPDO_mng();
$read="connection/conn_DB.txt";
$dbh->para_read($read);
$dbh->conn_PDO();
//$dbh->getDb();
    $data = array("Y", "Y", $userID, $return_date);
    $field=array("move_status","return_risk","return_user","return_date");
    $table = "takerisk";
    $where="takerisk_id=:takerisk_id";
    $execute=array(':takerisk_id' => $takerisk_id);
    $riskUpdate=$dbh->update($table, $data, $where, $field, $execute); 
    
    $sql = "select CONCAT(user_fname,' ',user_lname) AS fullname from user where user_id= :userID";
$execute=array(':userID' => $userID);
$dbh->imp_sql($sql);
$result=$dbh->select_a($execute);
if ($riskUpdate == false) {
    echo "false";
}else{
    $output = $userID.",";
    $output .= $result['fullname'].",";
    $output .= $userDep.",";
    $output .= $userMDep.",";
    $output .= $userStatus;
    echo $output;
}

?>
