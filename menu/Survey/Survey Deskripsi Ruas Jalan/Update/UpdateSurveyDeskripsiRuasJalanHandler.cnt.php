<?php
class UpdateSurveyDeskripsiRuasJalanHandlerContent extends ContentInterface{
	public function UpdateSurveyDeskripsiRuasJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$Query = $Conn->Execute("
			UPDATE svy_deskripsi_ruas_jalan SET
				post = '". $_POST['Post'] ."',
				offset = '". $_POST['Offset'] ."',				
				lebar = '". $_POST['Lebar'] ."',
				id__mst_lajur = NULLIF('". $_POST['NamaLajur']."','')
			WHERE
				id__mst_ruas_jalan = '". $Par->IDRuas ."' AND
				timestamp = '". $Par->WaktuSurvey ."' AND
				post = '". $Par->Post ."' AND
				offset = '". $Par->Offset ."' AND
				id__mst_lajur = '".$Par->IdLajur ."'
		");
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(
			array(
				'id__mst_ruas_jalan' => $Par->IDRuas,
				'timestamp' => $Par->WaktuSurvey,
				'post' => $_POST['Post'],
				'offset' => $_POST['Offset'],
				'id__mst_lajur' =>$_POST['NamaLajur'] 
			)
		);		
		$Par->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>