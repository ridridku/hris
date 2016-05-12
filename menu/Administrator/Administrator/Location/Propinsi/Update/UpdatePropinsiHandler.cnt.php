<?php

class UpdatePropinsiHandlerContent extends ContentInterface
{
  public function UpdatePropinsiHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();

	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$db->Execute("
		UPDATE mst_propinsi SET 
			id = '". $_POST['IdPropinsi']."',
			nama = '".$_POST['name']."',
			id__mst_balaibesar = '".$_POST['Balaibesar']."'
		WHERE (id='".$p->IdPropinsi."')  
	");

	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(
			array('id' => $_POST['IdPropinsi'])
		);

	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>