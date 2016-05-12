<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DownloadToViewMovieHandlerMenu extends AbstractHandlerMenu
{
  public $IdRuasJalan = NULL;
  public $Time = NULL;
  public $UnixTime =  NULL;
  public $Post = NULL;
  public $OffSet =  NULL;
  public $IdMovie = NULL;
  public function DownloadToViewMovieHandlerMenu(){
	AbstractHandlerMenu::AbstractHandlerMenu();
  }
  public function Name(){return 'Download To View Movie Handler';}
  public function Path(){return __FILE__;}
  public function ClassName(){return __CLASS__;}
  public function HasValidator(){return TRUE;}
  public function MakeApplication(){return SimpajatanApplication::Instance();}
  public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>