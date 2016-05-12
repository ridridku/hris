<?
require_once FW_DIR .  '/lib/CommonQuery.php';

class InsertDataReferencePointHandlerContent extends ContentInterface
{
  public function InsertDataReferencePointHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'time_stamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyName[0] = $p->IdLocRoad;
	$KeyName[1] = $p->TimeStamp;
	$KeyName[2] = $_POST['post'];
	$KeyName[3] = $_POST['offset'];
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$OldData = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan', $KeyColumn, $KeyName);
	if(!$OldData){
		$db->Execute("
			INSERT INTO `svy_drp_ruas_jalan` (
				`id__mst_ruas_jalan`,
				`time_stamp`,
				`post`,
				`offset`,
				`gps_lat`,
				`gps_lon`,
				`gps_alt`,
				`gps_elev`
			) VALUES (
				'". $p->IdLocRoad ."',
				'". $p->TimeStamp ."',
				'". $_POST['post'] ."',
				'". $_POST['offset'] ."',
				NULLIF('". $_POST['gps_lat'] ."', ''),
				NULLIF('". $_POST['gps_lon'] ."', ''),
				NULLIF('". $_POST['gps_alt'] ."', ''),
				NULLIF('". $_POST['gps_elev'] ."', '')
			)
		");
	}
	$db->Execute("COMMIT;");
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>