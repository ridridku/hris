<?php
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';

class GridDataReferencePointMenu extends CommonGridMenu{
	public function GridDataReferencePointMenu(){CommonGridMenu::CommonGridMenu();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function Name(){return 'Data Reference Point';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}
?>