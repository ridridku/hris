<?
class SystemContent extends ContentInterface
{
  public function SystemContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>