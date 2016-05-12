<?php
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';

class HakAksesUser2GridMenu extends CommonGridMenu{
	public $SelectedIdMenu = NULL;
	public $SelectedIdGroup = NULL;
	public function HakAksesUser2GridMenu(){CommonGridMenu::CommonGridMenu();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function Name(){return 'Hak Akses';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}
?>