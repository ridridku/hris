<?
/**
 * @package Content
 */
class CommonFilterLaporanHandlerContent extends ContentInterface
{
  public function CommonFilterLaporanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	var_dump($_POST['id_ruas_jalan']);
	$m = $p->MakeApplication()->GetRequest('id_propinsi');
	$p->Next->IdPropinsi = $m->IdPropinsi;
	$p->Next->IdRuasJalan = $_POST['id_ruas_jalan'];
	$Tail = new MonitoringSurveyJalanMenu();
	$Tail->IdPropinsi = $m->IdPropinsi;
	$Tail->IdRuasJalan = $_POST['id_ruas_jalan'];
	$p->Next->AddTail($Tail);
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>