<?php
class InsertSurveyRoadHandlerContent extends ContentInterface
{
  public function InsertSurveyRoadHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$TimeStamp = $_POST['tanggal'].' '.$_POST['waktu'];
	$CekQuery = $db->Execute("
		SELECT * FROM svy_ruas_jalan
		WHERE
			id__mst_ruas_jalan = '" . $p->IdRuasJalan ."'  AND
			time_stamp = '". $TimeStamp."'	
	");
			
	if ($db->RowCount($CekQuery) == 0) {	
		$sql = "
			INSERT INTO `svy_ruas_jalan` (
				`id__mst_ruas_jalan`,
				`time_stamp`,
				`deskripsi`
			) VALUES (
				'".$p->IdRuasJalan."',
				'".$TimeStamp."',
				NULLIF('".$_POST['deskripsi']."', '')
			)
		";
		$db->Execute($sql);
	}
	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(array(
		'id'=>$_POST['IdLocRoad'],
		'TimeStamp'=>$TimeStamp )	
	);
	$p->Next->IdLocRoad = $_POST['IdLocRoad'];	
	$p->Next->TimeStamp = $TimeStamp;	
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>