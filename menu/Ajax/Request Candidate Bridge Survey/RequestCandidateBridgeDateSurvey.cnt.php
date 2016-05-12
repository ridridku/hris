<?
require_once 'Zend/Json/Encoder.php';
/**
 * @package Content
 */
class RequestCandidateBridgeDateSurveyContent extends ContentInterface
{
  public function RequestCandidateBridgeDateSurveyContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT 
			timestamp
		FROM svy_posisi_jembatan
		WHERE
			id_mst_bridge = '".$p->IdPoint."' AND
			id__mst_ruas_jalan = '".$p->IdRuas."'
	");	
	
	$aLayer = 0;
	$d->data = array();
	while($R = $db->FetchObject($rsl)){
		$ReqPoint = new RequestCandidateBridgeDetailSurveyMenu();
		$ReqPoint->IdPoint = $p->IdPoint;
		$ReqPoint->IdRuas = $p->IdRuas;
		$ReqPoint->Date = $R->timestamp;
		$d->data[$aLayer]->id = $R->timestamp;
		$d->data[$aLayer]->nama = $R->timestamp;
		$d->data[$aLayer]->description = '<label style="font-size:smaller">Survey: '.$R->timestamp.'</label>';
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