<?
class AdministratorContent extends ContentInterface{
	public function AdministratorContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>