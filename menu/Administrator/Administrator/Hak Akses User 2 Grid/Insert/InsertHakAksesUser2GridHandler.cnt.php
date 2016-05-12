<?php

class InsertHakAksesUser2GridHandlerContent extends ContentInterface
{
  public function InsertHakAksesUser2GridHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();

	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$m = $p->MakeApplication()->GetRequest('id_group');
	$rsl = $db->Execute("
				SELECT * FROM sys_data_grid 
				WHERE 
						id__sys_menu_grid = '". $_POST['id_menu_grid'] ."' AND
						id__sys_group = '". $m->IdGroup ."'
				");
	
	if($db->RowCount($rsl)== 0){
		$db->Execute("
			INSERT INTO sys_data_grid 
			VALUES ('". $_POST['id_menu_grid'] ."', '". $m->IdGroup ."') 
		");  
	}
	

	$db->Execute("COMMIT;");
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>