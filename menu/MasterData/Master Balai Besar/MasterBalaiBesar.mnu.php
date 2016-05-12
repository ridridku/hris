<?php
require_once FW_DIR . '/menu/Common Master Tabel/CommonMasterTabel.mnu.php';

class MasterBalaiBesarMenu extends CommonMasterTabelMenu
{
  public function MasterBalaiBesarMenu(){
    CommonMasterTabelMenu::CommonMasterTabelMenu();
  }
  public function MakeFrame(){return SimpajatanFrame::Instance();}
  public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  public function Name(){return 'Master Balai Besar';}
  public function Tabel(){return 'mst_balaibesar';}
  public function TabelId(){return 'id';}
  public function TabelName(){return 'nama';}
  public function MakeApplication(){return SimpajatanApplication::Instance();}
   	public function IsAccessible(){
		return 
			$_SESSION[FrameworkSessionConstant::UserName] != NULL && 
			$_SESSION[SessionConstant::IdGroup] == GroupConstant::Administrator ;
	}  
}  
?>