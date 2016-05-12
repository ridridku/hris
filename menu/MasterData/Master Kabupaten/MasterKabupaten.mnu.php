<?
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class MasterKabupatenMenu extends CommonGridMenu{
	public $IdKabupaten = NULL;
	public function MasterKabupatenMenu(){CommonGridMenu::CommonGridMenu();}
  	public function Name(){return 'Master Kabupaten';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}

?>