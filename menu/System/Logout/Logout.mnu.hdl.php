<?
require_once 'database/SimpajatanMySql.dbs.php';

class LogoutMenuHandler extends AbstractHandlerMenu{
	public function LogoutMenuHandler(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return '<label style="color:#0066FF">Logout</label>';}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return BlankFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
}
?>