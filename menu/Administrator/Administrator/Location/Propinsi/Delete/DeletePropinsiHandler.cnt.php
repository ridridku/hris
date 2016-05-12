<?php

class DeletePropinsiHandlerContent extends ContentInterface{
	public function DeletePropinsiHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();
		$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$sql = "
			DELETE FROM `mst_propinsi` 
			WHERE `id`='" . $p->IdPropinsi ."'";		
		$db->Execute($sql);		
		$db->Execute("COMMIT;");
		$p->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>