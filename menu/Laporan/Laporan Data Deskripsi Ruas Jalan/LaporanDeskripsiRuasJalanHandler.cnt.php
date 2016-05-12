<?
class LaporanDeskripsiRuasJalanHandlerContent extends ContentInterface{

	public function LaporanDeskripsiRuasJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
/*		$m1 = $p->MakeApplication()->GetRequest('id_propinsi');
		$m = $p->MakeApplication()->GetRequest('id_ruas_jalan');		
*/		$p->Next->IdPropinsi = $p->IdPropinsi;
		$p->Next->IdRuasJalan = $p->IdRuasJalan;
		$p->Next->Time = $_POST['tanggal_survey'];
		$p->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>