<?php

class DeleteMasterSatuanKerjaContent extends ContentInterface
{
  public function DeleteMasterSatuanKerjaContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");

    $db->Execute("
	  DELETE FROM `mst_satker` 
	  WHERE `id`='" . $p->Kode ."'"
	);

  	$db->Execute("COMMIT;");

#   $m = new MasterSatuanKerjaMenu();
#	$m->Process($v);
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>