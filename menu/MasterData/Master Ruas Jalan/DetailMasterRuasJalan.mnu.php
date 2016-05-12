<?
class DetailMasterRuasJalanMenu extends MenuInterface{
	public $Kode = NULL;
	
	public function DetailMasterRuasJalanMenu(){
		MenuInterface::MenuInterface();

	}
	public function Name(){return 'Detail Master Ruas Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
/*require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class DetailMasterRuasJalanMenu extends MasterRuasJalanMenu{
	public $Kode = NULL;
	
	public function DetailMasterRuasJalanMenu(){MasterRuasJalanMenu::MasterRuasJalanMenu();}
  	public function Name(){return 'Detail Master Ruas Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return false;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankTitledFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}
*/
?>