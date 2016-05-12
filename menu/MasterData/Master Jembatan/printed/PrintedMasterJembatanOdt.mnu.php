<?php
class PrintedMasterJembatanOdtMenu extends AbstractHandlerMenu{
  public function PrintedMasterJembatanOdtMenu(){
    AbstractHandlerMenu::AbstractHandlerMenu();
  }
  public function Name(){return 'Cetak';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return false;}
  public function ClassName(){return __CLASS__;}
  public function HasValidator(){return TRUE;}
  public function MakeApplication(){return SimpajatanApplication::Instance();}
  public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
 
}
?>