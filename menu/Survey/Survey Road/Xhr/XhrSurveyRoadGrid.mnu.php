<?php
require_once FW_DIR . '/gui/xhr/XhrGuiFactory.php';
class XhrSurveyRoadGridMenu extends CommonGridMenu
{
	public $IdLocRoad = NULL;
	public $TimeStamp = NULL;

	public function XhrSurveyRoadGridMenu(){CommonGridMenu::CommonGridMenu();}
	public function Name(){return 'Active Road Survey';}

	public function OnSetKey($key = array()){
		$this->SelectedIdLocRoad = $key['IdLocRoad'];		
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
		}

	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankTitledFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeGuiFactory(){return new XhrGuiFactory();}
}
?>