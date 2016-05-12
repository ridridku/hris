<?php

require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';
require_once 'database/SimpajatanMySql.dbs.php';

	class MakeBarCodeMenu extends AbstractHandlerMenu
	{
		public $BarCodeText = NULL;
		public function MakeBarCodeMenu($BarCodeText = NULL){
		AbstractHandlerMenu::AbstractHandlerMenu();
		$this->BarCodeText = $BarCodeText;
	}
	public function Name(){return 'Bar Code Generator';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}

  
}
?>