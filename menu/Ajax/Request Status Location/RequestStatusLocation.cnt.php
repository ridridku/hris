<?php
require_once 'Zend/Json/Encoder.php';

class RequestStatusLocationContent extends ContentInterface
{
  public function RequestStatusLocationContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);
	
	$rsl_style = $db->Execute(" 
		SELECT 
			style, 
			o_expression 
		FROM status_style    
		WHERE id_loc_type = '". $p->IdLocType ."' 
		ORDER BY id_loc_type, order_to_normal  
	");	
	while($rec_style = $db->FetchObject($rsl_style)){
		$tmp_exp = unserialize($rec_style->o_expression);
		if($tmp_exp && $tmp_exp->Cek($db, $p->ParamToCek)){
			$d->statusSeverity = $rec_style->style;
			break;
		}	
		$d->statusSeverity = $rec_style->style;
	}	
	

	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>