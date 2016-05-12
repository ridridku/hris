<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class InsertPelaksanaKegiatanHandlerMenu extends AbstractHandlerMenu{
	public $kode = NULL;
	
	public function InsertPelaksanaKegiatanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Proses Tambah Pelaksana Kegiatan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>