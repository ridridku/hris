<? 
/**
 * @package Content
 */
class GrafikDataPerkerasanHandlerContent extends ContentInterface
{
  public function GrafikDataPerkerasanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$Laporan = new LaporanDataPerkerasanJalanMenu();
	$Laporan->IdPropinsi = $p->IdPropinsi;				
	$Laporan->IdRuasJalan = $p->IdRuasJalan;
	$Laporan->Time  = $p->Waktu ;
	$Laporan->IdLajur = $p->IdLajur;
	
	$Grafik = new GrafikDataPerkerasanMenu();
	$Grafik->IdPropinsi = $p->IdPropinsi;
	$Grafik->IdRuasJalan = $p->IdRuasJalan;
	$Grafik->Waktu = $p->Waktu;
	$Grafik->Km_Ke = $_POST['km_ke'];
	$Grafik->IdLajur = $p->IdLajur;
	$Next = $Laporan;
	$Next->AddTail($Grafik);
	$Next->Process($v);
	
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>