<?php

class InsertSectionHandlerContent extends ContentInterface
{
  public function InsertSectionHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");

	$CekQuery = $db->Execute("
		SELECT * FROM loc_section
		WHERE id='" . $_POST['IdSection'] ."' 
		");
			
	if ($db->RowCount($CekQuery) == 0) {	
		$sql = " INSERT INTO loc_section 
					(id,
					 name,
					 id_loc_city) 
			   VALUES ('".$_POST['IdSection']."',
			   		    '".$_POST['name']."',
					   '".$_POST['id_loc_city']."')
		
		";
		$db->Execute($sql);
	}
		
	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(array(
		'id'=>$_POST['IdSection'])	
	);
	$p->Next->IdSection = $_POST['IdSection'];	
	$p->Next->Process($v);

  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>