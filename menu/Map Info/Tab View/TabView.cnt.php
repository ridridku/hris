<?
require_once 'Zend/Json/Encoder.php';

class TabViewContent extends ContentInterface{
  public function TabViewContent(){ContentInterface::ContentInterface();}
  public function Show(ValidatorInterface $v){
  	ContentInterface::Assign('YuiRelatifPath', YUI_RELATIF_PATH);
	$p = $this->Parent();
	
	$popupTabViewMenus = array();
	for($i=0; $i<count($p->Tabs); $i++){
		$popupTabViewMenus[$i]->Name = $p->Tabs[$i]->Name();
		$popupTabViewMenus[$i]->Ref = $p->Tabs[$i]->Ref();
	}
	ContentInterface::Assign('popupTabViewMenus', Zend_Json_Encoder::encode($popupTabViewMenus));
	
  	ContentInterface::Assign('width', $p->Rect['width']);
  	ContentInterface::Assign('height', ($p->Rect['height'] - 40));

	ContentInterface::Show($v);
	ContentInterface::Display();
  }
  public function Path(){return __FILE__;}
}
?>