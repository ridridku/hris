<?php

class UpdateSectionHandlerContent extends ContentInterface
{
  public function UpdateSectionHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();

	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$db->Execute("UPDATE
			 loc_section SET 
			 		 id = '". $_POST['IdSection']."',
					 name='".$_POST['name']."',
					 id_loc_city='".$_POST['id_loc_city']."'
			 WHERE (id='".$p->IdSection."')  
	");

	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(
			array('id' => $_POST['IdSection'])
		);

	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>