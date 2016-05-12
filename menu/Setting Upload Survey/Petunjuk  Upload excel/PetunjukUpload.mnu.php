<?
class PetunjukUploadMenu extends MenuInterface
{
  public function PetunjukUploadMenu(){
    MenuInterface::MenuInterface();
  }
  public function MakeFrame(){return SimpajatanFrame::Instance();}
  public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  public function Name(){return '<label style="color:#C20000">Petunjuk Upload File Excel</label>';}
  public function Path(){return __FILE__;}
  public function ClassName(){return __CLASS__;}
  public function MakeApplication(){return SimpajatanApplication::Instance();}
}

/*class PetunjukUploadMenu extends AbstractHandlerMenu
{
  public function PetunjukUploadMenu(){
    AbstractHandlerMenu::AbstractHandlerMenu();
  }  
  public function Name(){return '<label style="color:#C20000">Petunjuk Upload File Excel</label>';}
  public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  public function Path(){return __FILE__;}
  public function ClassName(){return __CLASS__;}
  public function IsAccessible(){return true;}  
  public function MakeApplication(){return SimpajatanApplication::Instance();}
}  */
?>