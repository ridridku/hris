<?php
class InsertMasterKotaHandlerContent extends ContentInterface{
	public function InsertMasterKotaHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$RecordId = CommonQuery::GetId($Conn, 'mst_kota', 'id');	
		$Conn->Execute("
			  INSERT INTO `mst_kota` (
				id,	nama, id__mst_propinsi
			)VALUES( 
				'".$RecordId."', 
				'". $_POST['nama'] ."',
				nullif('". $_POST['id__mst_propinsi'] ."','-1')
			   )");
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$RecordId)	
		);		
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>