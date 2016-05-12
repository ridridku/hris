<?
class UpdateConfigMenu extends MenuInterface
{

  public $IdGroup = NULL;
  public $IsActive = NULL;
  public $IdMenu = NULL;
  
  public function UpdateConfigMenu($IdGroup = NULL,$IsActive = NULL, $IdMenu = NULL){
  	$this->IdGroup = $IdGroup;
	$this->IsActive = $IsActive;
	$this->IdMenu = $IdMenu;
	MenuInterface::MenuInterface();
  }
  public function Name(){return 'Update Configuration Menu';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>