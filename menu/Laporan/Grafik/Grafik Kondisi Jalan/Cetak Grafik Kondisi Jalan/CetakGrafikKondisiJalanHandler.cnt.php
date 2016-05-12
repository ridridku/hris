<? 
/**
 * @package Content
 */
class CetakGrafikKondisiJalanHandlerContent extends ContentInterface
{
  public function CetakGrafikKondisiJalanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	
	$p->Next->IdPropinsi = $p->IdPropinsi;
	$p->Next->IdRuasJalan = $p->IdRuasJalan;
	$p->Next->Waktu = $p->Waktu;
	$p->Next->Km_Ke = $_POST['km_ke'];
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>