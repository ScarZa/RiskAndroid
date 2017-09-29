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
                
$mng_date = isset($_POST['mng_date'])?$_POST['mng_date']:'';                
$incident_old = isset($_POST['incident_old'])?$_POST['incident_old']:'';
$check1 = isset($_POST['check1'])?$_POST['check1']:'';
$check2 = isset($_POST['check2'])?$_POST['check2']:'';
$check3 = isset($_POST['check3'])?$_POST['check3']:'';
$check4 = isset($_POST['check4'])?$_POST['check4']:'';
$check5 = isset($_POST['check5'])?$_POST['check5']:'';
$check6 = isset($_POST['check6'])?$_POST['check6']:'';
$check7 = isset($_POST['check7'])?$_POST['check7']:'';
$check8 = isset($_POST['check8'])?$_POST['check8']:'';
$check9 = isset($_POST['check9'])?$_POST['check9']:'';
$incident_differ = "$check1 $check2 $check3 $check4 $check5
           $check6 $check7 $check8 $check9";
$edit_summary = isset($_POST['edit_summary'])?$_POST['edit_summary']:'';
$edit_process = isset($_POST['edit_process'])?$_POST['edit_process']:'';
$evaluate = isset($_POST['evaluate'])?$_POST['evaluate']:'';
$mmg_rec_date = date("Y-m-d");
$mng_rec_time = date("H:i:s");
$mng_status = "Y";


if ($evaluate == '7 วัน') {
    $check_date = date('Y-m-d', strtotime("+7 days "));
} elseif ($evaluate == '15 วัน') {
    $check_date = date('Y-m-d', strtotime("+15 days "));
} elseif ($evaluate == '1 เดือน') {
    $check_date = date('Y-m-d', strtotime("+1 months "));
} elseif ($evaluate == '3 เดือน') {
    $check_date = date('Y-m-d', strtotime("+3 months "));
} elseif ($evaluate == '6 เดือน') {
    $check_date = date('Y-m-d', strtotime("+6 months "));
} elseif ($evaluate == '1 ปี') {
    $check_date = date('Y-m-d', strtotime("+1 years "));
} elseif ($evaluate == '') {
    $check_date = date('Y-m-d', strtotime("+7 days "));
}
// using PDO

$dbh=new dbPDO_mng();
$read="connection/conn_DB.txt";
$dbh->para_read($read);
$dbh->conn_PDO();
//$dbh->getDb();
    $data = array($userID, $incident_old, $incident_differ, $edit_summary,$edit_process
            ,$evaluate,$mmg_rec_date,$mng_rec_time,$mng_status,$mng_date,$check_date);
    $field=array("user_edit","incident_old","incident_differ","edit_summary","edit_process"
        ,"evaluate","mmg_rec_date","mng_rec_time","mng_status","mng_date","check_date");
    $table = "mngrisk";
    $where="takerisk_id=:takerisk_id";
    $execute=array(':takerisk_id' => $takerisk_id);
    $riskUpdate=$dbh->update($table, $data, $where, $field, $execute); 
    
    $data2 = array("N");
    $field2=array("move_status");
    $table2 = "takerisk";
    $where2="takerisk_id=:takerisk_id";
    $execute2=array(':takerisk_id' => $takerisk_id);
    $riskUpdate2=$dbh->update($table2, $data2, $where2, $field2, $execute2); 
    
    $sql = "select CONCAT(user_fname,' ',user_lname) AS fullname from user where user_id= :userID";
$execute=array(':userID' => $userID);
$dbh->imp_sql($sql);
$result=$dbh->select_a($execute);
if ($riskUpdate and $riskUpdate2 == false) {
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
