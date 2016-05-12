<?php
class DeleteSurveyPosisiJembatanHandlerContent extends ContentInterface{
	public function DeleteSurveyPosisiJembatanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$Conn->Execute("
			DELETE FROM svy_posisi_jembatan
			WHERE
				id_mst_bridge = '". $Par->IDJembatan ."' AND
				id__mst_ruas_jalan = '". $Par->IDRuas ."' AND
				`timestamp` = '". $Par->WaktuSurvey ."' AND
				post = '". $Par->Post ."' AND
				offset = '". $Par->Offset ."'
		");
		$Conn->Execute("COMMIT;");
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
}
?>