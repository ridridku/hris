<?php

require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';
//require_once 'database/SimpajatanMySql.dbs.php';

	class MakeGraphKondisiPerkerasanKmKeGeneratorMenu extends AbstractHandlerMenu
	{
		public $IdRuasJalan = NULL;
		public $Waktu = NULL;
		public $Km_Ke = NULL;
		public $IdLajur = NULL;
		public function MakeGraphKondisiPerkerasanKmKeGeneratorMenu($IdRuasJalan = NULL, $Waktu = NULL, $Km_Ke = NULL,$IdLajur = NULL){
		AbstractHandlerMenu::AbstractHandlerMenu();
		$this->IdRuasJalan = $IdRuasJalan;
		$this->Waktu = $Waktu;		
		$this->Km_Ke  = $Km_Ke;
		$this->IdLajur = $IdLajur;
	}
	public function Name(){return 'Bar Code Generator';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	
}
?>