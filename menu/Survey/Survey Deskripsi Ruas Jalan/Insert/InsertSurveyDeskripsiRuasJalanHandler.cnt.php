<?php
class InsertSurveyDeskripsiRuasJalanHandlerContent extends ContentInterface{
	public function InsertSurveyDeskripsiRuasJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$CekQuery = $Conn->Execute("
			SELECT * FROM svy_deskripsi_ruas_jalan
			WHERE
				id__mst_ruas_jalan = '" . $Par->IdLocRoad ."'  AND
				timestamp = '". $Par->TimeStamp ."' AND
				post = '". $_POST['Post'] ."' AND
				offset = '". $_POST['Offset'] ."' AND
				id__mst_lajur = '". $_POST['NamaLajur']."'
		");
			
		if ($Conn->RowCount($CekQuery) == 0) {	
			$Conn->Execute("
				INSERT INTO svy_deskripsi_ruas_jalan (
					`id__mst_ruas_jalan`,
					`timestamp`,
					`post`,
					`offset`,
					`id__mst_lajur`,
					`lebar`
				) VALUES (
					'". $Par->IdLocRoad ."',
					'". $Par->TimeStamp ."',
					'". $_POST['Post'] ."',
					'". $_POST['Offset'] ."',
					'". $_POST['NamaLajur'] ."',
					'". $_POST['Lebar'] ."'
				)
			");
		}
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(
			array(
				'id__mst_ruas_jalan' => $Par->IdLocRoad,
				'timestamp' => $Par->TimeStamp,
				'post' => $_POST['Post'],
				'offset' => $_POST['Offset'],
				'id__mst_lajur'=>$_POST['NamaLajur']
			)	
		);
		$Par->Next->IdLocRoad = $Par->IdLocRoad;
		$Par->Next->TimeStamp = $Par->TimeStamp;		
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
}
?>