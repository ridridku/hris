<?php
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';

class LibSvyRoadMenu extends CommonGridMenu{
	public function LibSvyRoadMenu(){CommonGridMenu::CommonGridMenu();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function Name(){return 'Data Survey of Road';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}
?>