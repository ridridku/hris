<?php

class InsertLoginContent extends ContentInterface
{
  public function InsertLoginContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$Par = $this->Parent();
  	$Conn = $Par->MakeDatabase();

    $Row = array();
  	$Gui = $Par->MakeGuiFactory();
	$Form = $Gui->MakeForm();
	
	$Row[0] = $Gui->MakeSubTitle();
	$Row[0]->TextToDisplay = 'Insert User Login';
	
	$Row[1] = $Gui->MakeTextBox();
	$Row[1]->Name = 'NamaUser';
	$Row[1]->TextToDisplay = 'User Name';
	$Row[1]->Size = 32;
	$Row[1]->MaxLength = 32;
	$Row[1]->AddValidator(new StringLengthValidator(32, 1));
	$Row[1]->AddValidator(new UserNameSameValidator($Row[1]->Name));

    $Row[2] = $Gui->MakeComboBox();
	$Row[2]->Name = 'NamaPetugas';
	$Row[2]->TextToDisplay = 'Operator Name';
	$Row[2]->FromQuery($Conn, "
		SELECT 
			`id` AS id, 
			name AS name 
		FROM sys_operator 
		ORDER BY name	
	");
	$Row[2]->ItemSelected = $Par->IdJenisBiaya;
	$Row[2]->AddValidator(new ComboBoxValidator($Row[2]));
	
	$Row[3] = $Gui->MakePasswordBox();
	$Row[3]->Name = 'Password';
	$Row[3]->TextToDisplay = 'Password';
	$Row[3]->Size = 32;
	$Row[3]->MaxLength = 32;
	$Row[3]->AddValidator(new PasswordValidator());

    $Row[4] = $Gui->MakePasswordBox();
	$Row[4]->Name = 'ConfirmPassword';
	$Row[4]->Value = $R->nilai;
	$Row[4]->TextToDisplay = 'Confirm Password';
	$Row[4]->Size = 32;
	$Row[4]->MaxLength = 32;
	$Row[4]->Addvalidator(new PasswordAreSameValidator($Row[3]->Name));
	$Row[4]->AddValidator(new PasswordValidator());

    $Row[5] = $Gui->MakeComboBox();
	$Row[5]->Name = 'IdGroup';
	$Row[5]->TextToDisplay = 'Group';
	$Row[5]->FromQuery($Conn, "
		SELECT 
			`id` AS id, 
			`nama` AS name
		FROM `sys_group` 
		ORDER BY `nama`
	");
	$Row[5]->AddValidator(new ComboBoxValidator($Row[5]));

	$Button = $Gui->MakeBottomButton();
	$Button->OnClickMenu = clone($Par->Child());
	$Row[6] = $Button;
	
	$Form->Action = new InsertLoginHandlerMenu();
	$Form->Action->Next = new EditLoginMenu();
	$Form->Action->Next->AddTail($Par->Child());
	
	for($a=0; $a<count($Row); $a++){
	  $Form->AddRowElement($Row[$a]);
	}
	$Form->Display($Par, $v);  
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>