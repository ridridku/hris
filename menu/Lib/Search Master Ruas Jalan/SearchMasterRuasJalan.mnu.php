<?php
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class SearchMasterRuasJalanMenu extends CommonGridMenu{
	public function SearchMasterRuasJalanMenu(){CommonGridMenu::CommonGridMenu();}
	public function Name(){return 'Cari Data Ruas Jalan';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}
?>