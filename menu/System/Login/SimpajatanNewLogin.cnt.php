<?
class SimpajatanNewLoginContent extends ContentInterface{
	public function SimpajatanNewLoginContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$db = $this->Parent()->MakeDatabase();
		$m = new SimpajatanLoginHandlerMenu();
		ContentInterface::Assign('ACTION_PAGE', $m->Ref());	
		ContentInterface::Display();
  	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>