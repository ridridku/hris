<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateSectionCityMenu extends AbstractHandlerMenu
{
	public $IdSection = NULL;
	public function RequestCandidateSectionCityMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
		}
	public function Name(){return 'Request Kandidat Kota PerSection';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>