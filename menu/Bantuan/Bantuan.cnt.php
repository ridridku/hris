<?

class BantuanContent extends ContentInterface
{
  public function BantuanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$db = $this->Parent()->MakeDatabase();
	$rsl = $db->Execute("
		SELECT path_to_manual 
		FROM sys_group 
		WHERE id = '". $_SESSION[SessionConstant::IdGroup] ."'
	");
	$rec = $db->FetchObject($rsl);
	header("location: " . $rec->path_to_manual);
  }
  public function Path(){return __FILE__;}
}
?>