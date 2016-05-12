<?php

class UpdateConfigHandlerContent extends ContentInterface
{
  public function UpdateConfigHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	
		$Conn->Execute("UPDATE sys_menu_group SET
							is_active = '".$_POST['is_active']."'
						WHERE
							id__sys_menu = '".$Par->IdMenu."' AND
							id__sys_group = '".$Par->IdGroup."'
						");

		$Conn->Execute("COMMIT;");
		$Par->Next->Process($v);
  	}
  
  
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>