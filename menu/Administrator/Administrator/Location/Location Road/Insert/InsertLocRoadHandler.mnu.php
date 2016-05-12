<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class InsertLocRoadHandlerMenu extends AbstractHandlerMenu
{
	public $IdRoad = NULL;
	public $IdStatus = NULL;
	
	public function InsertLocRoadHandlerMenu($IdRoad = NULL, $IdStatus = NULL){
		AbstractHandlerMenu::AbstractHandlerMenu();
			$this->IdRoad = $IdRoad;
			$this->IdStatus = $IdStatus;
	}
	public function Name(){return 'Proses Insert Loac Road';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>