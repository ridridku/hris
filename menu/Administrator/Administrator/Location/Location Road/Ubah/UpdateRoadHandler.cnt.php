<?php

class UpdateRoadHandlerContent extends ContentInterface
{
  public function UpdateRoadHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$sql = "
	  UPDATE loc_road 
	  SET 
			id='". $_POST['IdRoad'] ."', 
			name = NULLIF('". $_POST['name'] ."', ''), 
			id_loc_section ='". $_POST['id_loc_section'] ."', 
			id_loc_city_from = NULLIF('". $_POST['id_loc_city_from'] ."', ''), 
			id_loc_city_to = NULLIF('".$_POST['id_loc_city_to']."', ''),
			id_rod_status  = NULLIF('". $_POST['id_rod_status'] ."', ''),
			id_rod_function  = NULLIF('". $_POST['id_rod_function'] ."', '') 	 			  
	  WHERE id='" . $p->IdRoad ."' 
	";
	$db->Execute($sql); 
	
   	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(array(
		'id'=>$_POST['IdRoad'])	
	);
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>