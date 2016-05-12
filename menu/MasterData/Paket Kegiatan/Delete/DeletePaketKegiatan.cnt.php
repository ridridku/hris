<?php

class DeletePaketKegiatanContent extends ContentInterface
{
  public function DeletePaketKegiatanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");

    $db->Execute("
	  DELETE FROM `mst_propinsi` 
	  WHERE `id`='" . $p->Kode ."'"
	);

  	$db->Execute("COMMIT;");

#   $m = new PaketKegiatanMenu();
#	$m->Process($v);
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>