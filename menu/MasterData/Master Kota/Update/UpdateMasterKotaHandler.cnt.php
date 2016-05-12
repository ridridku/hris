<?php
class UpdateMasterKotaHandlerContent extends ContentInterface{
	public function UpdateMasterKotaHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$Conn->Execute("
			UPDATE `mst_kota` SET
				nama = '". $_POST['nama'] ."',
				id__mst_propinsi = '". $_POST['id__mst_propinsi'] ."'
			WHERE
				id = '". $Par->id ."'
		");			   
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$Par->id)	
		);		
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>