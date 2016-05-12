<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdatePelaksanaKegiatanHandlerMenu extends AbstractHandlerMenu{
	public $IdSatker = NULL;
	public $Kode = NULL;
	public $IdTahun = NULL;	
	public $Next = NULL;
	
	public function UpdatePelaksanaKegiatanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Proses Edit Pelaksana Kegiatan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>