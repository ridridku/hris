<?php
class DeleteMasterKotaHandlerContent extends ContentInterface{
	public function DeleteMasterKotaHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$Conn->Execute("
			DELETE FROM `mst_kota`
			WHERE
				id = '". $Par->id ."'
		");			   
		$Conn->Execute("COMMIT;");
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>