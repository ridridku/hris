<? 
/**
 * @package Content
 */
class GrafikKondisiJalanHandlerContent extends ContentInterface
{
  public function GrafikKondisiJalanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
/*	
	$p->Next->IdPropinsi = $p->IdPropinsi;
	$p->Next->IdRuasJalan = $p->IdRuasJalan;
	$p->Next->Waktu = $p->Waktu;
	$p->Next->Km_Ke = $_POST['km_ke'];
	$p->Next->Process($v);*/
	
	
		
	$Laporan = new LaporanKondisiRuasJalanMenu();
	$Laporan->IdPropinsi = $p->IdPropinsi;				
	$Laporan->IdRuasJalan = $p->IdRuasJalan;
	$Laporan->Time  = $p->Waktu ;
	
	$Grafik = new GrafikKondisiJalanMenu();
	$Grafik->IdPropinsi = $p->IdPropinsi;
	$Grafik->IdRuasJalan = $p->IdRuasJalan;
	$Grafik->Waktu = $p->Waktu;
	$Grafik->Km_Ke = $_POST['km_ke'];
	
	
	$Next = $Laporan;
	$Next->AddTail($Grafik);
	$Next->Process($v);
	
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>