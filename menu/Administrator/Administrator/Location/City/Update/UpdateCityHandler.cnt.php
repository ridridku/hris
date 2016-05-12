<?php

class UpdateCityHandlerContent extends ContentInterface
{
  public function UpdateCityHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();

	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$db->Execute("UPDATE
			 loc_city SET 
			 		 id = '". $_POST['IdCity']."',
					 name='".$_POST['name']."',
					 id_loc_province='".$_POST['id_loc_province']."'
			 WHERE (id='".$p->IdCity."')  
	");

	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(
			array('id' => $_POST['IdCity'])
		);

	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>