<?
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class LocationRoadMenu extends CommonGridMenu
{
	public $IdRoad = NULL;

	public function LocationRoadMenu(){CommonGridMenu::CommonGridMenu();}
	public function OnSetKey($key = array()){
		$this->SelectedIdLoan = $key['Id_Loan'];		
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
		}
	public function Name(){return 'Road';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}

?>