<?
/**
 * @package Content
 */
class LaporanKondisiTepiJalanHandlerContent extends ContentInterface
{
  public function LaporanKondisiTepiJalanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$p->Next->IdPropinsi = $p->IdPropinsi;
	$p->Next->IdRuasJalan = $p->IdRuasJalan;
	$p->Next->Time = $_POST['tanggal_survey'];
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>