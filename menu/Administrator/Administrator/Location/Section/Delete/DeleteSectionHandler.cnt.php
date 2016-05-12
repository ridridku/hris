<?php

class DeleteSectionHandlerContent extends ContentInterface
{
  public function DeleteSectionHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$sql = "
	  DELETE FROM `loc_section` 
	  WHERE `id`='" . $p->IdSection ."'";

    $db->Execute($sql);

  	$db->Execute("COMMIT;");
	$p->Next->Process($v);  

//  $m = new GridMenu();
//	$m->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>