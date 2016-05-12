<?php
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class SectionGridMenu extends CommonGridMenu
{
	public $IdSection = NULL;

	public function SectionGridMenu(){CommonGridMenu::CommonGridMenu();}
	public function Name(){return 'Section';}

	public function OnSetKey($key = array()){
		$this->SelectedIdSection = $key['IdSection'];		
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
		}

	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}
?>