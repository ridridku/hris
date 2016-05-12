<?
/**
 * @package Content
 */
class DeleteDataReferencePointHandlerContent extends ContentInterface
{
  public function DeleteDataReferencePointHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	
	
	for($i=0; $i<5; $i++){
	$FileName = UPLOAD_DIR . 'movie/' . $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset . '-' . $i . '.flv';
		if(file_exists($FileName)){
			$Delete = unlink($FileName);
		}		
	}
	
	for($i=0; $i<5; $i++){
	$FileName = UPLOAD_DIR .$p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset . '-' . $i ;
		if(file_exists($FileName)){
			$Delete = unlink($FileName);
		}		
	}	
		
	
	$db->Execute("
		DELETE FROM `svy_drp_ruas_jalan`
		WHERE
			(`id__mst_ruas_jalan` = '". $p->IdRoad ."') AND
			(`time_stamp` = '". $p->TimeSurvey ."') AND
			(`post` = '". $p->Post ."') AND
			(`offset` = '". $p->Offset ."')
	");
	$db->Execute("COMMIT;");
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>