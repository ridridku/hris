<?
/**
 * @package Content
 */
class InfoJembatanContent extends ContentInterface
{
  public function InfoJembatanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
  	ContentInterface::Assign('width', $p->Rect['width'] - 15);
  	ContentInterface::Assign('height', $p->Rect['height']);
	$KeyColumn[0] = 'id';
	$KeyName[0] = $p->IdBridge;
	$OldData = CommonQuery::ReadTable($db, 'mst_bridge', $KeyColumn, $KeyName);
	ContentInterface::Assign('id', $OldData['id']);
	ContentInterface::Assign('nama_jembatan', $OldData['nama']);
	ContentInterface::Assign('bentang', $OldData['bentang']);
	ContentInterface::Assign('panjang', $OldData['panjang']);
	ContentInterface::Assign('lebar', $OldData['lebar']);
	ContentInterface::Assign('tipe_ba', $OldData['tipe_ba']);
	ContentInterface::Assign('tipe_bb', $OldData['tipe_bb']);
	ContentInterface::Assign('status', $OldData['status']);
	ContentInterface::Assign('lat', $OldData['start_gps_lat']);
	ContentInterface::Assign('lon', $OldData['start_gps_lon']);
	ContentInterface::Assign('alt', $OldData['start_gps_alt']);
	ContentInterface::Assign('jml_pier', $OldData['jml_pier']);
	ContentInterface::Assign('jarak_pier_abutmen', $OldData['jarak_pier_abutmen']);
	ContentInterface::Assign('jarak_pier_pier', $OldData['jarak_pier_pier']);
	ContentInterface::Assign('lebar_median', $OldData['lebar_median']);
	ContentInterface::Assign('lebar_trotoir', $OldData['lebar_trotoir']);
	ContentInterface::Assign('lebar_perkerasan', $OldData['lebar_perkerasan']);
	ContentInterface::Assign('bahu_jalan', $OldData['bahu_jalan']);
    ContentInterface::Show($v);
	ContentInterface::Display();
  }
  public function Path(){return __FILE__;}
}
?>