<?
class UpdatePasswordHandlerContent extends ContentInterface
{
  public function UpdatePasswordHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$Par = $this->Parent();
	$Conn = $Par->MakeDatabase();	
	$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
	$Conn->Execute("
		UPDATE sys_login
		SET	password = '". md5($_POST['ConfirmNewPassword']) ."'
		WHERE user_name =  '". $_SESSION[FrameworkSessionConstant::UserName] ."'
	");	
	$Conn->Execute("COMMIT;");	
	$Par->Next->Process($v);	
  }
  public function Path(){return __FILE__;}
}
?>