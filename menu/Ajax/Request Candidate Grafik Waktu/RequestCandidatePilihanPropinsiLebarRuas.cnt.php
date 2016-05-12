<?
require_once 'Zend/Json/Encoder.php';

class RequestCandidatePilihanPropinsiLebarRuasContent extends ContentInterface
{
  public function RequestCandidatePilihanPropinsiLebarRuasContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = new ResultInflectorWrapperDatabase($p->MakeDatabase());
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);
	$rsl = $db->Execute(new QueryFilter("
		SELECT
				CONCAT(id, ' ') AS id_mst_ruas_jalan,
				CONCAT(id,'  |  ',nama_ruas,'  ') AS name,
				`mst_ruas_jalan`.`id__mst_propinsi`
			FROM
				mst_ruas_jalan
			WHERE
				mst_ruas_jalan.id__mst_propinsi = '". $p->IdPropinsi ."'
		ORDER BY id
	",
		new ColModifierResultInflector(
			$Child = new NoResultInflector(),
			new DynamicNameColModifier(
				$Child = new NoColModifier()
			)	
		)	
	));	

	while($R = $db->FetchObject($rsl)){
		$d->id_mst_ruas_jalan[] = $R->id_mst_ruas_jalan;
		$d->nama[] = $R->name;			
		$m = new RequestCandidateTanggalSurveyDataMenu();
		$m->IdJalan = $R->id_mst_ruas_jalan;
		$d->requestChildsMenu[] = $m->Ref();
	}
	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
}
?>