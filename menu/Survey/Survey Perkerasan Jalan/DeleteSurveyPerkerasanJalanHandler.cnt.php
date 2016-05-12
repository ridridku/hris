<?php

class DeleteSurveyPerkerasanJalanHandlerContent extends ContentInterface{
	public function DeleteSurveyPerkerasanJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$Conn = $p->MakeDatabase();
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$Conn->Execute("
			DELETE FROM svy_perkerasan_jalan 
			WHERE
				id__mst_ruas_jalan = '" . $p->IdRuasJalan ."'  AND
				timestamp = '". $p->TimeStamp ."' AND
				post = '" . $p->Post ."'  AND
				offset = '" . $p->Offset ."'  AND
				id__mst_lajur = '" . $p->IdLajur ."' AND
				id__mst_perkerasan = '" . $p->IdPerkerasan ."'  				
		");
		$Conn->Execute("COMMIT;");
		$p->Next->Process($v);
	}
	public function Path(){return __FILE__;}
}
?>