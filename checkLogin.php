<?php
//include_once 'connection/connect.php';
function __autoload($class_name) {
    include_once 'class/'.$class_name.'.php';
}

$user_account = md5(trim(filter_input(INPUT_POST, 'user_account',FILTER_SANITIZE_ENCODED)));
$user_pwd = md5(trim(filter_input(INPUT_POST, 'user_pwd',FILTER_SANITIZE_ENCODED)));

// using PDO
?>
<?php
$dbh=new dbPDO_mng();
$read="connection/conn_DB.txt";
$dbh->para_read($read);
$dbh->conn_PDO();
//$dbh->getDb();
$sql = "select * from user 
           inner join department on user.dep_id=department.dep_id
           inner join department_group on department.main_dep=department_group.main_dep
           where   user_account= :user_account && user_pwd= :user_pwd";
$execute=array(':user_account' => $user_account, ':user_pwd' => $user_pwd);
$dbh->imp_sql($sql);
$result=$dbh->select_a($execute);

if ($result) {
    $output = $result['user_id'].",";
    $output .= $result['user_fname'].' '.$result['user_lname'].",";
    $output .= $result['dep_id'].",";
    $output .= $result['main_dep'].",";
    $output .= $result['admin'];
    echo $output;
$date = new DateTime(null, new DateTimeZone('Asia/Bangkok'));//กำหนด Time zone
$date_login = $date->format('Y-m-d');
$time_login = time();
                $table = "user";
                $data = array($date_login,$time_login);
                $field = array("date_login","time_login");
                $where = "user_account= :user_account && user_pwd= :user_pwd";
                $execute = array(':user_account' => $user_account, ':user_pwd' => $user_pwd);
                $edit_address = $dbh->update($table, $data, $where, $field, $execute);
                //echo "Login สำเร็จ";
       //echo "<body onload='onLoad='KillMe();self.focus();window.opener.location.reload();'>" ;        
}else{
	echo "false";
    //exit();
}

?>
