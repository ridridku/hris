<?php
class UploadFileSurveyKondisiJalanMenu extends MenuInterface{
	public $IdPropinsi = NULL;
  	public $RuasAwal = NULL;  
	public $RuasAkhir = NULL;
	public function UploadFileSurveyKondisiJalanMenu(){
		MenuInterface::MenuInterface();
	}
	public function Name(){return 'Survey Kondisi Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>