<?php

class UpdateUserHandlerContent extends ContentInterface
{
  public function UpdateUserHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");

	$db->Execute("
	  UPDATE `sys_operator` 
	  SET 
			`id`='". $_POST['Kode'] ."', 
			`address`= NULLIF('". $_POST['alamat'] ."', ''), 
			`name`='". $_POST['name'] ."', 
			`telp`= NULLIF('". $_POST['telp'] ."', ''), 
			`email` = NULLIF('".$_POST['email']."', ''),
			`sms`  = NULLIF('". $_POST['sms'] ."', ''),
			id_mst_balaibesar = NULLIF('".$_POST['id_mst_balaibesar']."','') 			  
	  WHERE `id`='" . $p->Kode ."' 
	"); 
	
   	$db->Execute("COMMIT;");

	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>