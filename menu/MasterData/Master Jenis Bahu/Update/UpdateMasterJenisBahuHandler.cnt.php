<?php

class UpdateMasterJenisBahuHandlerContent extends ContentInterface{
	public function UpdateMasterJenisBahuHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$Conn->Execute("
			UPDATE mst_jenis_bahu 
			SET 
				nama = '". $_POST['NamaJenisBahu'] ."',
				id__mst_bahu_group = '". $_POST['BahuGroup'] ."'
			WHERE id = '" . $Par->IDJenisBahu ."' 
		");		
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$Par->IDJenisBahu)	
		);
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>