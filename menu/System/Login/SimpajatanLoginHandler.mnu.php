<?php
require_once 'database/SimpajatanMySql.dbs.php';

class SimpajatanLoginHandlerMenu extends AbstractHandlerMenu{
	public function SimpajatanLoginHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}  
  	public function Name(){return 'Proses Masuk';}
	public function MakeDatabase(){
		return new ResultInflectorWrapperDatabase(
			SimpajatanMySqlDatabase::Instance()
		);	
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
}  
?>