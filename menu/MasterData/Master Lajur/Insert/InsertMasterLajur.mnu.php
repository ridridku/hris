<?php

class InsertMasterLajurMenu extends MenuInterface{
	public function InsertMasterLajurMenu(){MenuInterface::MenuInterface();}
	public function Name(){return 'Tambah Master Lajur Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>