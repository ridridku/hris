<?PHP
//ini_set('max_execution_time',300); //300 seconds = 5 minutes
//require_once('../includes/db.conf.php');
//require_once('../adodb/adodb.inc.php');
//require_once('../includes/config.conf.php');

require_once('D:xampp/htdocs/hris/includes/db.conf.php');
require_once('D:xampp/htdocs/hris/adodb/adodb.inc.php');
require_once('D:xampp/htdocs/hris/includes/config.conf.php');
$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;1800000
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
$sql8 = "UPDATE tbl_sys_master_user SET user_session_aktif = '0' where user_session_aktif=1";
$rs_val = $db->Execute($sql8);
$user_id= $rs_val->fields["user_id"];
mysqldump -u root -p adminhris db_hris_tmw_full >tes_backup.sql
header('Location:http://localhost/hris/index.php');
exit();

?>


