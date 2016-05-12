<?php

class DeleteLocRoadHandlerContent extends ContentInterface
{
  public function DeleteLocRoadHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");

    $db->Execute("
	  DELETE FROM loc_road 
	  WHERE id='" . $p->IdRoad ."'"
	);

  	$db->Execute("COMMIT;");
	$p->Next->Process($v);  
//    $m = new GridUserMenu();
//	$m->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>