<?php

class DeleteMasterJenisBahuContent extends ContentInterface
{
  public function DeleteMasterJenisBahuContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
    $db->Execute("
			DELETE FROM mst_jenis_bahu
			WHERE `id`='" . $p->IDJenisBahu ."'"
	);
  	$db->Execute("COMMIT;");
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>