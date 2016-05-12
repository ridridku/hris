<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeleteLocRoadHandlerMenu extends AbstractHandlerMenu
{
	public $IdRoad = NULL;
	public $Next = NULL;
	
	public function DeleteLocRoadHandlerMenu($IdRoad = NULL){
		AbstractHandlerMenu::AbstractHandlerMenu();
			$this->IdRoad = $IdRoad;
	}
	
	public function Name(){return 'Proses Delete Loc Road';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>