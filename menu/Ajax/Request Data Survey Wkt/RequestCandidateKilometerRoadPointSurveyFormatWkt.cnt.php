<?
require_once 'Zend/Json/Encoder.php';
/**
 * @package Content
 */
class RequestCandidateKilometerRoadPointSurveyFormatWktContent extends ContentInterface
{
  public function RequestCandidateKilometerRoadPointSurveyFormatWktContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT
			DISTINCT(`svy_ruas_jalan`.id__mst_ruas_jalan) AS id,
			`mst_ruas_jalan`.nama_ruas AS nama_ruas
		FROM
			`svy_ruas_jalan`,
			`mst_ruas_jalan`
		WHERE
			`svy_ruas_jalan`.id__mst_ruas_jalan = `mst_ruas_jalan`.id AND
			`mst_ruas_jalan`.id__mst_propinsi = '". $p->IdPropinsi ."'
		ORDER BY nama_ruas ASC
	");	
	
	$aLayer = 0;
	$d->data = array();
	while($R = $db->FetchObject($rsl)){
		$ReqWkt = new RequestDataSurveyFormatWktMenu();
		$ReqWkt->IdRuasJalan = $R->id;
		$ReqWkt->IdPropinsi = $p->IdPropinsi;
		$d->data[$aLayer]->id = $R->id;
		$d->data[$aLayer]->nama = $R->nama_ruas;
		$d->data[$aLayer]->description = '<label style="font-size:smaller">'. $R->nama_ruas .'</label>';
		$d->data[$aLayer]->statusSeverity = 'site-normal';
		$d->data[$aLayer]->isLeaf = 1;
		$d->data[$aLayer]->isSymbology = 0;
		$d->data[$aLayer]->menuRequestGoeFormatWkt = $ReqWkt->Ref();
		$d->data[$aLayer]->hasChildMap = 0;
		$aLayer++;
	}

	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
}
?>