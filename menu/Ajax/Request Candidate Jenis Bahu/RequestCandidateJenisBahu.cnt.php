<?php
require_once 'Zend/Json/Encoder.php';

class RequestCandidateJenisBahuContent extends ContentInterface
{
  public function RequestCandidateJenisBahuContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = new ResultInflectorWrapperDatabase($p->MakeDatabase());
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);
	$rsl = $db->Execute(new QueryFilter("
		SELECT
			mst_jenis_bahu.id as id,
			mst_jenis_bahu.nama as name

		FROM
			mst_jenis_bahu
		WHERE
		   mst_jenis_bahu.id__mst_bahu_group =  '". $p->IdGroupBahu ."'
		ORDER BY mst_jenis_bahu.nama 
	
			
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