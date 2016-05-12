<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateSectionContent extends ContentInterface
{
  public function UpdateSectionContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $Gui = $p->MakeGuiFactory();
	$sql = " SELECT *
			 FROM
			 	loc_section
			 WHERE
				id = '".$p->IdSection."'
	";
	$rsl = $db->Execute($sql);
	$r = $db->FetchObject($rsl);
	$Provinsi = $r->id_loc_city;
	$Name = $r->name;

	
	$Form = $Gui->MakeForm();
	$Form->FormName = 'Data Section';
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Update Section';
	$Form->AddRowElement($r);

   	$r = $Gui->MakeTextBox();
	$r->TextToDisplay = 'Id';
	$r->Name = 'IdSection';
	$r->Value = $p->IdSection;
	$r->Size = 20;
	$r->Maxlength = 11;
    $r->Mandatory = TRUE;
	$r->AddValidator(new CommonMasterTableIdValidator('loc_section', $p->IdSection));
	$r->AddValidator(new StringLengthValidator(11, 1));	
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeTextArea();
	$r->TextToDisplay = 'Nama';
	$r->Name = 'name';
	$r->Value = $Name;
	$r->Column =45;
	$r->Rows = 2;
	$r->Maxlength = 129;
    $r->Mandatory = false;
	$r->AddValidator(new StringLengthValidator(128, 1));
	$Form->AddRowElement($r);

	$r = $Gui->MakeComboBox();
	$r->TextToDisplay = 'City';
	$r->Name = 'id_loc_city';
	$r->ItemSelected = $Provinsi;
	$r->Mandatory = false;
	$r->FromQuery($db, "
		SELECT id AS id, name AS name 
		FROM `loc_city`"
	 );
	$r->AddValidator(new ComboBoxValidator($r));
	$Form->AddRowElement($r);
	
    $r = $Gui->MakeLabel();
	$Form->AddRowElement($r);

    $r = $Gui->MakeBottomButton();
	$r->OnClickMenu = clone($p->Child());
	$Form->AddRowElement($r);
	
	
	$Form->Action = new UpdateSectionHandlerMenu();
	$Form->Action->IdSection = $p->IdSection; 
	$Form->Action->Next = new UpdateSectionMenu();
	$Form->Action->Next->AddTail($p->Child());
		
	$Form->Display($p, $v);

  }
 
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>