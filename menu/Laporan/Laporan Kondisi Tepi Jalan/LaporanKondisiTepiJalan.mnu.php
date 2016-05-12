<?
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class LaporanKondisiTepiJalanMenu extends CommonGridMenu{
	public $IdPropinsi =  NULL;
	public $IdRuasJalan =  NULL;
	public $Time = NULL;
	public $Post = NULL;
	public $OffSet = NULL;
	public function LaporanKondisiTepiJalanMenu(){CommonGridMenu::CommonGridMenu();}
  	public function Name(){return 'Kondisi Tepi Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankTitledFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}

?>