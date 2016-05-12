<?php

class InsertCityHandlerContent extends ContentInterface
{
  public function InsertCityHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");

	$CekQuery = $db->Execute("
		SELECT * FROM loc_city
		WHERE id='" . $_POST['IdCity'] ."' 
		");
			
	if ($db->RowCount($CekQuery) == 0) {	
		$sql = " INSERT INTO loc_city 
					(id,
					 name,
					 id_loc_province) 
			   VALUES ('".$_POST['IdCity']."',
			   		    '".$_POST['name']."',
					   '".$_POST['id_loc_province']."')
		
		";
		$db->Execute($sql);
	}
		
	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(array(
		'id'=>$_POST['IdCity'])	
	);
	$p->Next->IdCity = $_POST['IdCity'];	
	$p->Next->Process($v);

  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>