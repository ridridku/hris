<?
require_once 'Zend/Json/Encoder.php';

class RequestCandidatePilihanPropinsiContent extends ContentInterface
{
  public function RequestCandidatePilihanPropinsiContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = new ResultInflectorWrapperDatabase($p->MakeDatabase());
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);
	$rsl = $db->Execute(new QueryFilter("
		SELECT
			`id` AS id,
			CONCAT(id,' | ',nama_ruas,'    ' ) AS name
		FROM mst_ruas_jalan
		WHERE id__mst_propinsi = '". $p->IdPropinsi ."'
		ORDER BY name
	",
		new ColModifierResultInflector(
			$Child = new NoResultInflector(),
			new DynamicNameColModifier(
				$Child = new NoColModifier()
			)	
		)	
	));	

	while($R = $db->FetchObject($rsl)){
		$d->id[] = $R->id;
		$d->nama[] = $R->name;
	}
	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
}
?>