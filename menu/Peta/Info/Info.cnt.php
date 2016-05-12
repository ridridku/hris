<?
/**
 * @package Content
 */
class InfoContent extends ContentInterface
{
  public function InfoContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
  	ContentInterface::Assign('width', $p->Rect['width'] - 15);
  	ContentInterface::Assign('height', $p->Rect['height']);
	$KeyColumn[0] = 'id';
	$KeyName[0] = $p->IdRoad;
	$OldData = CommonQuery::ReadTable($db, 'mst_ruas_jalan', $KeyColumn, $KeyName);
	ContentInterface::Assign('id', $OldData['id']);
	ContentInterface::Assign('nama_ruas', $OldData['nama_ruas']);
    ContentInterface::Show($v);
	ContentInterface::Display();
  }
  public function Path(){return __FILE__;}
}
?>