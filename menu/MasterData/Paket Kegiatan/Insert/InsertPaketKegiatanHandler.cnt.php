<?php
class InsertPaketKegiatanHandlerContent extends ContentInterface{
	public function InsertPaketKegiatanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
/*		$CekQuery = $Conn->Execute("
			SELECT * FROM mst_propinsi
			WHERE `id`='" . $_POST['Kode'] ."' 
		");				
		if ($Conn->RowCount($CekQuery) == 0) {		  
			$Conn->Execute("
			  INSERT INTO `mst_propinsi` (
				id,	nama, id__mst_balaibesar
			)VALUES( 
				'". $_POST['Kode'] ."', 
				'". $_POST['NamaPropinsi'] ."',
				'". $_POST['BalaiBesar'] ."'
			   )");
		}		
*/		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$_POST['Kode'])	
		);
		$Par->Next->Kode = $_POST['Kode'];	
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>