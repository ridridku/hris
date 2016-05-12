<?php

class BangunanBawahJembatanMenu extends MenuInterface
{
	public $IdJembatan = NULL;
	
	public function BangunanBawahJembatanMenu(){
		MenuInterface::MenuInterface();
	}
	public function Name(){return 'Bangunan Jembatan Bawah';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>