<?php
require_once 'Zend/Json/Encoder.php';

class RequestCandidateTanggalSurveyDataContent extends ContentInterface
{
  public function RequestCandidateTanggalSurveyDataContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = new ResultInflectorWrapperDatabase($p->MakeDatabase());
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);
	$rsl = $db->Execute(new QueryFilter("
		SELECT
			`svy_ruas_jalan`.`time_stamp` as id,
			`svy_ruas_jalan`.`time_stamp` as name
		FROM `svy_ruas_jalan`
		WHERE `svy_ruas_jalan`.`id__mst_ruas_jalan` =  '". $p->IdJalan ."'
		GROUP BY `svy_ruas_jalan`.`time_stamp` 
	
			
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