<?php
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class PropinsiGridMenu extends CommonGridMenu
{
	public $IdPropinsi = NULL;

	public function PropinsiGridMenu(){CommonGridMenu::CommonGridMenu();}
	public function Name(){return 'Propinsi';}

	public function OnSetKey($key = array()){
		$this->SelectedIdPropinsi = $key['Id_Loan'];		
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
		}

	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeGuiFactory(){return new ConfigurableGuiFactory();}
}
?>