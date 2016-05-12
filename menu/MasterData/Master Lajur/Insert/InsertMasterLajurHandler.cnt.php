<?php
class InsertMasterLajurHandlerContent extends ContentInterface{
	public function InsertMasterLajurHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$CekQuery = $Conn->Execute("
			SELECT * FROM mst_lajur
			WHERE id ='" . $_POST['IDLajur'] ."' 
		");				
		if ($Conn->RowCount($CekQuery) == 0) {		  
			$Conn->Execute("
				INSERT INTO mst_lajur (
					id,
					nama,
					deskripsi,
					`order`
				)VALUES( 
					'". $_POST['IDLajur'] ."',
					'". $_POST['NamaLajur'] ."',
					NULLIF('". $_POST['Deskripsi'] ."', ''),
					NULLIF('". $_POST['Order'] ."', '')
				)"
			);
		}		
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