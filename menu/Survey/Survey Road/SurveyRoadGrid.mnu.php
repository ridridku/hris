<?php
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class SurveyRoadGridMenu extends CommonGridMenu
{
	public $IdLocRoad = NULL;
	public $TimeStamp = NULL;

	public function SurveyRoadGridMenu(){CommonGridMenu::CommonGridMenu();}
	public function Name(){return 'Data Survey Ruas Jalan';}

	public function OnSetKey($key = array()){
		$this->SelectedIdLocRoad = $key['IdLocRoad'];		
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