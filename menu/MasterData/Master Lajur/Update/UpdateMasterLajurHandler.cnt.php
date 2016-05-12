<?php

class UpdateMasterLajurHandlerContent extends ContentInterface{
	public function UpdateMasterLajurHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$Conn->Execute("
			UPDATE mst_lajur 
			SET 
				id = '". $_POST['IDLajur'] ."',
				nama = '". $_POST['NamaLajur'] ."',
				deskripsi = NULLIF('". $_POST['Deskripsi'] ."', ''),
				`order` = NULLIF('". $_POST['Order'] ."', '')
			WHERE id = '" . $Par->IDLajur ."' 
		");		
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$_POST['IDLajur'])	
		);
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>