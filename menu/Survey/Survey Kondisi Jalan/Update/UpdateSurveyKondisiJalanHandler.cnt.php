<?php
class UpdateSurveyKondisiJalanHandlerContent extends ContentInterface{
	public function UpdateSurveyKondisiJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();
		$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$sql = "
			UPDATE svy_kondisi_ruas_jalan SET
				post = '". $_POST['Post'] ."',
				offset = '". $_POST['Offset'] ."',
				id__mst_kondisi_jalan = '". $_POST['KondisiJalan'] ."'
			WHERE
				id__mst_ruas_jalan = '". $p->IdRuasJalan ."' AND
				timestamp = '". $p->Time ."' AND
				post = '". $p->Post ."' AND
				offset = '". $p->Offset ."' AND
				id__mst_lajur = '". $p->IdLajur ."'
		";echo $sql;
		$db->Execute($sql);
		$db->Execute("COMMIT;");
		$p->Next->OnSetKey(
			array(
				'id__mst_ruas_jalan' => $p->IdRuasJalan,
				'timestamp' => $p->Time,
				'post' => $_POST['Post'],
				'offset' => $_POST['Offset'],
				'id__mst_lajur' => $p->IdLajur,
			)
		);	
		$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>