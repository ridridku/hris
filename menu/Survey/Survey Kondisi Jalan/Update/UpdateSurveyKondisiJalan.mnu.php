<?php
class UpdateSurveyKondisiJalanMenu extends MenuInterface{
	public $IdRuasJalan = NULL;
	public $Time = NULL;
	public $Post = NULL;
	public $Offset = NULL;
	public $IdLajur = NULL;	
    
	public function UpdateSurveyKondisiJalanMenu(){
		MenuInterface::MenuInterface();
	}
	
	public function Name(){return 'Update Survey Kondisi Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>