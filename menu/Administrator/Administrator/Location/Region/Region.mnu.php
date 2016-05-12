<?php
require_once FW_DIR . '/menu/Common Master Tabel/CommonMasterTabel.mnu.php';

class RegionMenu extends CommonMasterTabelMenu{
  public function RegionMenu(){
    CommonMasterTabelMenu::CommonMasterTabelMenu();
  }
  public function MakeFrame(){return SimpajatanFrame::Instance();}
  public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  public function Name(){return 'Region';}
  public function Tabel(){return 'loc_region';}
  public function TabelId(){return 'id';}
  public function TabelName(){return 'name';}
  public function MakeApplication(){return SimpajatanApplication::Instance();}
}  
?>