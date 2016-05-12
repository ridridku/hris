<?php

class InsertPropinsiHandlerContent extends ContentInterface
{
  public function InsertPropinsiHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();	
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");

	$CekQuery = $db->Execute("
		SELECT * FROM mst_propinsi
		WHERE id = '" . $_POST['IdPropinsi'] ."' 
		");
			
	if ($db->RowCount($CekQuery) == 0) {
		$sql = " 
			INSERT INTO mst_propinsi (
				id,
				nama,
				id__mst_balaibesar
			) VALUES (
				'".$_POST['IdPropinsi']."',
				'".$_POST['name']."',
				'".$_POST['Balaibesar']."'
			)		
		";
		$db->Execute($sql);
	}
		
	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(array(
		'id'=>$_POST['IdPropinsi'])	
	);
	$p->Next->IdPropinsi = $_POST['IdPropinsi'];	
	$p->Next->Process($v);

  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>