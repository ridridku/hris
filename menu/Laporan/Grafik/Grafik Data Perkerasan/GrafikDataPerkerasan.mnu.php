<?
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class GrafikDataPerkerasanMenu extends CommonGridMenu{
	public $IdPropinsi = NULL;
	public $IdRuasJalan = NULL;
	public $Waktu =  NULL;
	public $Km_Ke = NULL;
	public $IdLajur =  NULL;
	public function GrafikDataPerkerasanMenu(){CommonGridMenu::CommonGridMenu();}
  	public function Name(){return 'Grafik Data Perkerasan Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankTitledFrame::Instance();}
#	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}

?>