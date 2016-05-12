<?php

class InsertUserHandlerContent extends ContentInterface
{
  public function InsertUserHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");

	$CekQuery = $db->Execute("
		SELECT * FROM sys_operator
		WHERE `id`='" . $_POST['Kode'] ."' 
		");
			
	if ($db->RowCount($CekQuery) == 0) {		  
		$db->Execute("
		  INSERT INTO `sys_operator` (
		  	id,	name, address, telp, email, sms,id_mst_balaibesar 
		)VALUES( 
			'". $_POST['Kode'] ."', 
			'". $_POST['name'] ."', 
			NULLIF('". $_POST['alamat'] ."', ''), 
			NULLIF('". $_POST['telp'] ."', ''), 
			NULLIF('". $_POST['email'] ."', ''),
			NULLIF('". $_POST['sms'] ."', ''),
			NULLIF('". $_POST['id_mst_balaibesar']."','')
		   )");
	}
		
	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(array(
		'id'=>$_POST['Kode'])	
	);
	$p->Next->Kode = $_POST['Kode'];	
	$p->Next->Process($v);

  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>