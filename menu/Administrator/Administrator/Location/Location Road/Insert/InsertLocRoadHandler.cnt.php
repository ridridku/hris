<?php

class InsertLocRoadHandlerContent extends ContentInterface
{
  public function InsertLocRoadHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$sql = "
		  INSERT INTO loc_road 
		  		(`id`, `name`, `id_loc_section`,`id_loc_city_from`,
				 `id_loc_city_to`,`id_rod_status`,`id_rod_function`)
		  VALUES( 
			'". $_POST['IdRoad'] ."', 
			'". $_POST['name'] ."', 
			NULLIF('". $_POST['id_loc_section'] ."', ''), 
			NULLIF('". $_POST['id_loc_city_from'] ."', ''), 
			NULLIF('". $_POST['id_loc_city_to'] ."', ''),
			NULLIF('". $_POST['id_rod_status'] ."', ''),
			NULLIF('". $_POST['id_rod_function'] ."', '')
		   )"; 
	$db->Execute($sql);		
	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(array(
		'id'=>$_POST['IdRoad'])	
	);
	$p->Next->IdRoad = $_POST['IdRoad'];	
	$p->Next->Process($v);

  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>