<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeletePelaksanaKegiatanMenu extends AbstractHandlerMenu{
  	public $IdSatker = NULL;
	public $IdTahun = NULL;
	public $Next = NULL;	
	
	public function DeletePelaksanaKegiatanMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}	
	public function Name(){return 'Proses Delete Pelaksana Kegiatan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>