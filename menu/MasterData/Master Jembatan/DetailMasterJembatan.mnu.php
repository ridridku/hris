<?
class DetailMasterJembatanMenu extends MenuInterface{
	public $IDJembatan = NULL;
	
	public function DetailMasterJembatanMenu(){
		MenuInterface::MenuInterface();

	}
	public function Name(){return 'Detail Master Jembatan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}

/*require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class DetailMasterJembatanMenu extends MasterJembatanMenu{
	public $IDJembatan = NULL;
	
	public function DetailMasterJembatanMenu(){MasterJembatanMenu::MasterJembatanMenu();}
  	public function Name(){return 'Detail Master Jembatan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankTitledFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}
*/
?>