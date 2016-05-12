<?
class UpdatePasswordContent extends ContentInterface
{
  public function UpdatePasswordContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$Par = $this->Parent();
	$Conn = $Par->MakeDatabase();
	$rsl = $Conn->Execute("
		SELECT
			user_name, 			
			password
		FROM
			sys_login
		WHERE 
			user_name = '". $_SESSION[FrameworkSessionConstant::UserName] ."'
	");
	$Old = $Conn->FetchObject($rsl);	

	$Row = array();
  	$Gui = $Par->MakeGuiFactory();
	$Form = $Gui->MakeForm();
	
	$Row[0] = $Gui->MakeSubTitle();
	$Row[0]->TextToDisplay = 'Update Password User';
	
	$Row[1] = $Gui->MakeLabel();
	$Row[1]->Name = 'UserName';
	$Row[1]->Value = $Old->user_name;
	$Row[1]->TextToDisplay = 'User Nama';
	$Row[1]->Size = 32;
	$Row[1]->MaxLength = 32;

	$Row[2] = $Gui->MakePasswordBox();
	$Row[2]->Name = 'OldPassword';
	$Row[2]->TextToDisplay = 'Old Password';
	$Row[2]->Size = 32;
	$Row[2]->MaxLength = 32;
	$Row[2]->AddValidator(new OldPasswordNotSameValidator($Row[2]->Name));
	$Row[2]->AddValidator(new PasswordValidator());
	
	$Row[3] = $Gui->MakePasswordBox();
	$Row[3]->Name = 'NewPassword';	
	$Row[3]->TextToDisplay = 'New Password';
	$Row[3]->Size = 32;
	$Row[3]->MaxLength = 32;
	$Row[3]->AddValidator(new PasswordValidator());

    $Row[4] = $Gui->MakePasswordBox();
	$Row[4]->Name = 'ConfirmNewPassword';
	$Row[4]->TextToDisplay = 'Confirm New Password';
	$Row[4]->Size = 32;
	$Row[4]->MaxLength = 32;
	$Row[4]->Addvalidator(new PasswordAreSameValidator($Row[3]->Name));
	$Row[4]->AddValidator(new PasswordValidator());

	$Row[5] = $Gui->MakeBottomButton();
	
	$Form->Action = new UpdatePasswordHandlerMenu();
	$Form->Action->Next = clone($Par);
	
	for($a=0; $a<count($Row); $a++){
	  $Form->AddRowElement($Row[$a]);
	}
	$Form->Display($Par, $v);
	
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>