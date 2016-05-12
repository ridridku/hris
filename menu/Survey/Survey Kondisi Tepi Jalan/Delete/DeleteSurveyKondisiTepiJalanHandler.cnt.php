<?php

class DeleteSurveyKondisiTepiJalanHandlerContent extends ContentInterface{
	public function DeleteSurveyKondisiTepiJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$Conn->Execute("
			DELETE FROM svy_kondisi_tepi_jalan 
			WHERE
				`id__mst_ruas_jalan` = '" . $Par->IDRuas ."'  AND
				`timestamp` = '". $Par->TimeStamp ."' AND
				`post` = '" . $Par->Post ."'  AND
				`offset` = '" . $Par->Offset ."'  AND
				`id__mst_lajur` = '" . $Par->IDLajur ."'				
		");
		$Conn->Execute("COMMIT;");
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
}
?>