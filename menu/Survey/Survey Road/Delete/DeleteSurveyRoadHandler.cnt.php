<?php

class DeleteSurveyRoadHandlerContent extends ContentInterface
{
  public function DeleteSurveyRoadHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$sql = "
	  DELETE FROM svy_ruas_jalan 
	  WHERE
	  	id__mst_ruas_jalan ='" . $p->IdLocRoad ."' AND
		time_stamp = '". $p->TimeStamp."'
	";
    $db->Execute($sql);

  	$db->Execute("COMMIT;");
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>