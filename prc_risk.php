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
                
                $cate = isset($_POST['cate'])?$_POST['cate']:'';
                $subCate = isset($_POST['subCate'])?$_POST['subCate']:'';
                $cateName = isset($_POST['cateName'])?$_POST['cateName']:'';
                $take_rec_time=date("H:i:s");
                $take_rec_date=date("Y-m-d");
                $takeDate = isset($_POST['takeDate'])?$_POST['takeDate']:'';
                $takeTime = isset($_POST['takeTime'])?$_POST['takeTime']:'';
                $takePlace = isset($_POST['takePlace'])?$_POST['takePlace']:'';
                $hn = isset($_POST['hn'])?$_POST['hn']:'';
                $an = isset($_POST['an'])?$_POST['an']:'';
                $takeOther = isset($_POST['takeOther'])?$_POST['takeOther']:'';
                $resDep = isset($_POST['resDep'])?$_POST['resDep']:'';
                $take_detail = isset($_POST['take_detail'])?$_POST['take_detail']:'';
                $take_first = isset($_POST['take_first'])?$_POST['take_first']:'';
                $take_counsel = isset($_POST['take_counsel'])?$_POST['take_counsel']:'';
                $level_risk = isset($_POST['level_risk'])?$_POST['level_risk']:'';
                $take_file1 = '';
                $take_file2 = '';
                $take_file3 = '';
// using PDO

$dbh=new dbPDO_mng();
$read="connection/conn_DB.txt";
$dbh->para_read($read);
$dbh->conn_PDO();
//$dbh->getDb();
$data = array($cate, $subCate, $userDep, $resDep, $takePlace, $level_risk, $hn, $an, $takeDate, $takeTime, $takeTime, $take_detail
        , $takeOther, $take_first, $take_counsel, $take_rec_date, $take_rec_time, $take_file1, $take_file2, $take_file3, 'Y', $userID);
    $table = "takerisk";
    $add_risk = $dbh->insert($table, $data);
    $data2 = array($add_risk);
    $table2 = 'mngrisk';
    $add_mngrisk = $dbh->insert($table2, $data2);
    
    $sql = "select CONCAT(user_fname,' ',user_lname) AS fullname from user where user_id= :userID";
$execute=array(':userID' => $userID);
$dbh->imp_sql($sql);
$result=$dbh->select_a($execute);
if ($add_risk and $add_mngrisk == false) {
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
