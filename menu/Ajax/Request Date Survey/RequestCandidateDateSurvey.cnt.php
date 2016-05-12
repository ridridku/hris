<?
require_once 'Zend/Json/Encoder.php';
/**
 * @package Content
 */
class RequestCandidateDateSurveyContent extends ContentInterface
{
  public function RequestCandidateDateSurveyContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT 
			time_stamp
		FROM svy_ruas_jalan
		WHERE
			id__mst_ruas_jalan = '".$p->IdPoint."'
	");	
	
	$aLayer = 0;
	$d->data = array();
	while($R = $db->FetchObject($rsl)){
		$ReqPoint = new RequestCandidateDetailPointSurveyMenu();
		$ReqPoint->IdPoint = $p->IdPoint;
		$ReqPoint->Date = $R->time_stamp;
		$d->data[$aLayer]->id = $R->time_stamp;
		$d->data[$aLayer]->nama = $R->time_stamp;
		$d->data[$aLayer]->description = '<label style="font-size:smaller">Survey: '.$R->time_stamp.'</label>';
		$d->data[$aLayer]->statusSeverity = 'site-normal';
		$d->data[$aLayer]->isLeaf = 1;
		$d->data[$aLayer]->isSymbology = 0;
		$d->data[$aLayer]->menuRequestPoint = $ReqPoint->Ref();
		$d->data[$aLayer]->hasChildMap = 0;
		$aLayer++;
	}

	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
}
?>