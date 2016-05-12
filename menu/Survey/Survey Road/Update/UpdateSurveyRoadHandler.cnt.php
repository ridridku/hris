<?php
class UpdateSurveyRoadHandlerContent extends ContentInterface
{
  public function UpdateSurveyRoadHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$TimeStamp = $_POST['tanggal'].' '.$_POST['waktu'];
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$sql = "
		UPDATE svy_ruas_jalan SET
			id__mst_ruas_jalan = '".$p->Kode."',
			time_stamp = '".$TimeStamp."',
			deskripsi = NULLIF('".$_POST['deskripsi']."', '')
		WHERE
			(id__mst_ruas_jalan = '".$p->IdLocRoad."') AND
			(time_stamp = '". $p->TimeStamp."')
	"; 
	$db->Execute($sql);
	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(
			array('id' => $_POST['IdLocRoad'], 'time_stamp' => $TimeStamp)
		);

	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>