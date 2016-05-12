<?php

class UpdateMasterPropinsiHandlerContent extends ContentInterface{
	public function UpdateMasterPropinsiHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$Conn->Execute("
			UPDATE mst_propinsi 
			SET  
				nama = '". $_POST['NamaPropinsi'] ."', 
				id__mst_balaibesar = '". $_POST['BalaiBesar'] ."'
			WHERE id = '" . $Par->Kode ."' 
		");		
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$Par->Kode)	
		);
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>