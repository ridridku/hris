<? 
/**
 * @package Content
 */
class GridDataSurveyVideoJalanHandlerContent extends ContentInterface
{
  public function GridDataSurveyVideoJalanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	/*$TimeStamp = $_POST['date'] . ' ' . $_POST['time'];
	$p->Next->IdPropinsi = $_POST['id_propinsi'];
	$p->Next->IdRuasJalan = $_POST['id_ruas_jalan'];
	$p->Next->Time = $_POST['tanggal_survey'];
	$p->Next->Process($v);*/
	
		$p->Next->IdPropinsi = $p->IdPropinsi;
		$p->Next->IdRuasJalan = $p->IdRuasJalan;
		$p->Next->Time = $_POST['tanggal_survey'];
		$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>