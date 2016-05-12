<?php
class InsertMasterPropinsiHandlerContent extends ContentInterface{
	public function InsertMasterPropinsiHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$RecordId = CommonQuery::GetId($Conn, 'mst_propinsi', 'id');
		$SQL = "
			  INSERT INTO `mst_propinsi` (
				id,	nama, id__mst_balaibesar
			)VALUES( 
				'". $RecordId ."', 
				'". $_POST['NamaPropinsi'] ."',
				'". $_POST['BalaiBesar'] ."'
			   )";
		$Conn->Execute($SQL);
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$RecordId)	
		);
		$Par->Next->Kode = $RecordId;	
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>