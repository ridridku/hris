<?php

class DeleteLoginContent extends ContentInterface
{
  public function DeleteLoginContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$Par = $this->Parent();
	$Conn = $Par->MakeDatabase();
	$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$Conn->Execute("
		DELETE FROM
			`sys_login`
		WHERE
			user_name = '".$Par->NamaUser."'
	");
	$Conn->Execute("
		DELETE FROM
			sys_login_region
		WHERE
			user_name = '".$Par->NamaUser."'
	");
	$Conn->Execute("COMMIT;");
	$Par->Next->Process($v);  
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>