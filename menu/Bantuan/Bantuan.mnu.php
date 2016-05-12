<?
class BantuanMenu extends AbstractHandlerMenu
{
	public function BantuanMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}  
	public function Ref($IsFromRoot = TRUE){
		$db = $this->MakeDatabase();
		$rsl = $db->Execute("
			SELECT path_to_manual 
			FROM sys_group 
			WHERE id = '". $_SESSION[SessionConstant::IdGroup] ."'
		");
		$rec = $db->FetchObject($rsl);
	if($rec->path_to_manual == NULL)return NULL;
	else return AbstractHandlerMenu::Ref($IsFromRoot);
	}
	public function Name(){return '<label style="color:#009900">Bantuan</label>';}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
}  
?>