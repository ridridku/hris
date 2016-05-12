<?php

class EditHakAksesUser2GridHandlerContent extends ContentInterface
{
  public function EditHakAksesUser2GridHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();

	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$db->Execute("
		DELETE FROM sys_data_grid_access 
		WHERE 
			id__sys_menu_grid = '". $p->IdMenuClass ."' AND 
			id__sys_group  = '". $p->IdGroup ."' 
	");  
	if(count($_POST['roles']) > 0){
		foreach($_POST['roles'] as $key => $value){
			$db->Execute("
				INSERT INTO sys_data_grid_access 
				VALUES ('". $p->IdMenuClass ."', '". $p->IdGroup ."', '". $value ."') 
			");  
		}
	}	

	$db->Execute("COMMIT;");
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>