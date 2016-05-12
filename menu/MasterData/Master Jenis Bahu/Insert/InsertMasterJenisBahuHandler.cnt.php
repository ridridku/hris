<?php
class InsertMasterJenisBahuHandlerContent extends ContentInterface{
	public function InsertMasterJenisBahuHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$RecordId = CommonQuery::GetId($Conn, 'mst_propinsi', 'id');
		$Conn->Execute("
				INSERT INTO mst_jenis_bahu (
					id,
					nama,
					id__mst_bahu_group
				)VALUES( 
					'". $RecordId."',
					'". $_POST['NamaJenisBahu'] ."',
					'". $_POST['BahuGroup'] ."'
				)"
			);
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