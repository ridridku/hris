<?php
require_once 'Zend/Json/Encoder.php';

class RequestMapServerContent extends ContentInterface
{
	private $errorList = array(
		'msQueryByPoint(): Search returned no results. No matching record(s) found.', 
		'msLoadMap(): Unable to access file.', 
		'msEvalRegex(): Regular expression error.'
	);  	

  public function RequestMapServerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);
	$d->resultStatus = 'OK';
	
	$d->contents = file_get_contents(
		URL_GET_CONTENT . '?' . 
		'map=' . $p->Map . 
		'&mode=' . $p->Mode . 
		'&img.x=' . $p->ImgX . 
		'&img.y=' . $p->ImgY . 
		'&imgext=' . $p->ImgExtLeft . '+' . 
			$p->ImgExtBottom . '+' . 
			$p->ImgExtRight . '+' . 
			$p->ImgExtTop . 
		'&layers=' . $p->Layers . 
		'&imgsize=' . $p->ImgSizeW . '+' . $p->ImgSizeH	);

	$d->dump = 
		URL_MAP_SERVER . '?' . 
		'map=' . $p->Map . 
		'&mode=' . $p->Mode . 
		'&img.x=' . $p->ImgX . 
		'&img.y=' . $p->ImgY . 
		'&imgext=' . $p->ImgExtLeft . '+' . 
			$p->ImgExtBottom . '+' . 
			$p->ImgExtRight . '+' . 
			$p->ImgExtTop . 
		'&layers=' . $p->Layers . 
		'&imgsize=' . $p->ImgSizeW . '+' . $p->ImgSizeH;
	
	for($i=0; $i<count($this->errorList); $i++)	
	if(strpos ( $d->contents, $this->errorList[$i]) !== FALSE){
		$d->resultStatus = 'ERROR';
	}	

	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
}
?>