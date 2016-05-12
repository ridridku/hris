<?php

class DeleteUserContent extends ContentInterface
{
  public function DeleteUserContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");

    $db->Execute("
	  DELETE FROM `sys_operator` 
	  WHERE `id`='" . $p->Kode ."'"
	);

  	$db->Execute("COMMIT;");

    $m = new GridUserMenu();
	$m->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>