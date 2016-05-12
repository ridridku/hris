<?
require_once 'Zend/Json/Encoder.php';
/**
 * @package Content
 */
class RequestCandidateDataProvinceSurveyContent extends ContentInterface
{
  public function RequestCandidateDataProvinceSurveyContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT * 
		FROM mst_propinsi
	");	
	
	$aLayer = 0;
	$d->data = array();
	while($R = $db->FetchObject($rsl)){
		$d->data[$aLayer]->id = $R->id;
		$d->data[$aLayer]->nama = $R->nama;
		$d->data[$aLayer]->description = $R->nama;
		$d->data[$aLayer]->statusSeverity = 'site-normal';
		$d->data[$aLayer]->isLeaf = 0;
		$d->data[$aLayer]->isSymbology = 0;
		
		$d->data[$aLayer]->hasChildMap = 1;
		$m = new RequestCandidateDataPointSurveyMenu();
		$m->IdPropinsi = $R->id;
		$d->data[$aLayer]->requestChildsMenu = $m->Ref();
		$aLayer++;
	}

	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
}
?>