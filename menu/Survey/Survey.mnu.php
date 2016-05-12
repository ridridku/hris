<?php
class SurveyMenu extends MenuInterface{
	public function SurveyMenu(){
		MenuInterface::MenuInterface();
	}  
	public function Name(){return 'Survey';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
}  
?>