<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class EditLoginContent extends ContentInterface
{
  public function EditLoginContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
  	$Conn = $p->MakeDatabase();
  echo'aaaaa';
  var_dump($p->NamaUser);
  	$rsl = $Conn->Execute("
		SELECT * 
		FROM sys_login 
		WHERE user_name = '". $p->NamaUser ."'
	");
	$Old = $Conn->FetchObject($rsl);
  
    $Row = array();
  	$Gui = $p->MakeGuiFactory();
	$Form = $Gui->MakeForm();
	
	$Row[0] = $Gui->MakeSubTitle();
	$Row[0]->TextToDisplay = 'Update User Login';

	$Row[1] = $Gui->MakeTextBox();
	$Row[1]->Name = 'NamaUser';
	$Row[1]->Value = $p->NamaUser ;
	$Row[1]->TextToDisplay = 'User Name';
	$Row[1]->Size = 32;
	$Row[1]->MaxLength = 32;
	$Row[1]->AddValidator(new StringLengthValidator(32, 1));

    $Row[2] = $Gui->MakeComboBox();
	$Row[2]->Name = 'Nip' ; 
    $Row[2]->ItemSelected = $Old->id__sys_operator;
	$Row[2]->TextToDisplay = 'Operator Name';
	$Row[2]->FromQuery($Conn, "
		SELECT 
			`id` AS id, 
			name AS name 
		FROM 
			sys_operator 
		ORDER BY name
	");

	$Row[3] = $Gui->MakePasswordBox();
	$Row[3]->Name = 'OldPassword';
	$Row[3]->TextToDisplay = 'OldPassword';
	$Row[3]->Size = 32;
	$Row[3]->MaxLength = 32;
	$Row[3]->AddValidator(new UpdateOldPasswordNotSameValidator($p->NamaUser,$Row[3]->Name));
	$Row[3]->AddValidator(new PasswordValidator());

	$Row[4] = $Gui->MakePasswordBox();
	$Row[4]->Name = 'Password';
	$Row[4]->TextToDisplay = 'Password';
	$Row[4]->Size = 32;
	$Row[4]->MaxLength = 32;
	$Row[4]->AddValidator(new PasswordValidator());

    $Row[5] = $Gui->MakePasswordBox();
	$Row[5]->Name = 'ConfirmPassword';
	$Row[5]->TextToDisplay = 'Confirm Password';
	$Row[5]->Size = 32;
	$Row[5]->MaxLength = 32;
	$Row[5]->Addvalidator(new PasswordAreSameValidator($Row[4]->Name));
	$Row[5]->AddValidator(new PasswordValidator());

    $Row[6] = $Gui->MakeComboBox();
	$Row[6]->Name = 'IdGroup' ; 
    $Row[6]->ItemSelected = $Old->id_group;
	$Row[6]->TextToDisplay = 'Group';
	$Row[6]->FromQuery($Conn, "
		SELECT 
			`id` AS id, 
			`nama` AS name 
		FROM `sys_group` 
		ORDER BY `nama`
	");
	$Row[6]->AddValidator(new ComboBoxValidator($Row[6]));

	$Button = $Gui->MakeBottomButton();
	$Button->OnClickMenu = clone($p->Child());
	
	$Row[7] = $Button;
	
	$Form->Action = new EditLoginHandlerMenu($p->NamaUser, $p->Password, $p->Nip, $p->IdGroup);
	$Form->Action->Next = clone($p);
	
	for($a=0; $a<count($Row); $a++){
	  $Form->AddRowElement($Row[$a]);
	}
	$Form->Display($p, $v);
  }
 
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>