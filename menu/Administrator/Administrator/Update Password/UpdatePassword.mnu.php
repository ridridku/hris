<?php
class UpdatePasswordMenu extends MenuInterface
{
  	public function UpdatePasswordMenu(){MenuInterface::MenuInterface();}
  	public function Name(){return '<label style="color:#0066FF">Ubah Password</label>';}
  	public function Path(){return __FILE__;}
  	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>