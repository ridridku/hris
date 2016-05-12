<?
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class DetailMasterSatuanKerjaMenu extends MasterSatuanKerjaMenu{
	public $Kode = NULL;
	
	public function DetailMasterSatuanKerjaMenu(){MasterSatuanKerjaMenu::MasterSatuanKerjaMenu();}
  	public function Name(){return 'Detail Master Satuan Kerja';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankTitledFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}

?>