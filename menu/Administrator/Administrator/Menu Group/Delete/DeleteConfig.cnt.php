<?php

class DeleteConfigContent extends ContentInterface
{
  public function DeleteConfigContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$Par = $this->Parent();
	$Conn = $Par->MakeDatabase();
	$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$SQL ="
		DELETE FROM
			sys_menu_group
		WHERE
			id__sys_group = '".$Par->IdGroup."' AND
			is_active = '".$Par->IsActive."' AND
			id__sys_menu ='". $Par->IdMenu."' 
	";
	$Conn->Execute($SQL);
	$Conn->Execute("COMMIT;");
	$Par->Next->Process($v);  
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>