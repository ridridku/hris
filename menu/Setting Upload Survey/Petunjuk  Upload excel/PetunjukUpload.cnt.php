<?

class PetunjukUploadContent extends ContentInterface
{
  public function PetunjukUploadContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	ContentInterface::Show($v);
	ContentInterface::Display();

 /*
  	$db = $this->Parent()->MakeDatabase();
	$rsl = $db->Execute("
		SELECT path_to_manual 
		FROM sys_group
		WHERE id = '". $_SESSION[SessionConstant::IdGroup] ."'
	");
	$rec = $db->FetchObject($rsl);
	header("location: " . "doc/user manual/Petunjuk_Upload.doc");
*/
  }
  public function Path(){return __FILE__;}
}
?>