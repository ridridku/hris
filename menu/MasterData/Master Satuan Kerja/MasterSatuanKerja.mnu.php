<?
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class MasterSatuanKerjaMenu extends CommonGridMenu{
	public $Kode = NULL;
	public function MasterSatuanKerjaMenu(){CommonGridMenu::CommonGridMenu();}
  	public function Name(){return 'Master Satuan Kerja';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}

?>