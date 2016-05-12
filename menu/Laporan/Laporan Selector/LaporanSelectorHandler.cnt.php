<?
/**
 * @package Content
 */
class LaporanSelectorHandlerContent extends ContentInterface
{
  public function LaporanSelectorHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$m = $p->MakeApplication()->GetRequest('id_propinsi');
#	$p->Next->IdPropinsi = $m->IdPropinsi;
#	$p->Next->IdRuasJalan = $_POST['id_ruas_jalan'];
	
	$LaporanSelector = new LaporanSelectorMenu();
	$LaporanSelector->IdPropinsi = $m->IdPropinsi;
	$LaporanSelector->IdRuasJalan = rtrim($_POST['id_ruas_jalan']);
	$Next = $LaporanSelector;
	$MonitoringTab = new MonitoringTabViewMenu();
	$MonitoringTab->IdPropinsi = $m->IdPropinsi;
	$MonitoringTab->IdRuasJalan = $_POST['id_ruas_jalan'];
	$Next->AddTail($MonitoringTab);
	$Next->Process($v);
/*	var_dump('Ruas Jalan ' . $_POST['id_ruas_jalan']);
	var_dump('Propinsi ' . $m->IdPropinsi);
	alert(YAHOO.lang.dump(oResults));
*/	
	
#	$Tail = new MonitoringSurveyJalanMenu();
#	$Tail->IdPropinsi = $m->IdPropinsi;
#	$Tail->IdRuasJalan = $_POST['id_ruas_jalan'];
#	$p->Next->AddTail($Tail);
#	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>