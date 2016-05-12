<?
require_once 'database/SimpajatanMySql.dbs.php';

class SimpajatanLoginMenu extends MenuInterface{
	public function SimpajatanLoginMenu(){
		MenuInterface::MenuInterface();
	}  
	public function Name(){return 'Masuk';}
  	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankFrame::Instance();}
	public function MakeDatabase(){
		return new ResultInflectorWrapperDatabase(
			SimpajatanMySqlDatabase::Instance()
		);	
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
}  
?>