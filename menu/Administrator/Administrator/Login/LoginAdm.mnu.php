<?php
require_once FW_DIR . '/gui/configurable/ConfigurableGuiFactory.php';
class LoginAdmMenu extends CommonGridMenu
{
	public $SelectedNama = NULL;

	public function LoginAdmMenu(){CommonGridMenu::CommonGridMenu();}
	public function Name(){return 'Pengaturan Pengguna';}

	public function OnSetKey($key = array()){
		$this->SelectedNama = $key['user_name'];		
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