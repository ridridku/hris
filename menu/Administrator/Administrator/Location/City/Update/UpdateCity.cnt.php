<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateCityContent extends ContentInterface
{
  public function UpdateCityContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $Gui = $p->MakeGuiFactory();
	$sql = " SELECT *
			 FROM
			 	loc_city
			 WHERE
				id = '".$p->IdCity."'
	";
	$rsl = $db->Execute($sql);
	$r = $db->FetchObject($rsl);
	$Provinsi = $r->id_loc_province;
	$Name = $r->name;

	
	$Form = $Gui->MakeForm();
	$Form->FormName = 'Data';
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Update City';
	$Form->AddRowElement($r);

   	$r = $Gui->MakeTextBox();
	$r->TextToDisplay = 'No Loan';
	$r->Name = 'IdCity';
	$r->Value = $p->IdCity;
	$r->Size = 20;
	$r->Maxlength = 11;
    $r->Mandatory = TRUE;
	$r->AddValidator(new CommonMasterTableIdValidator('loc_city', $p->IdCity));
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
	$r->TextToDisplay = 'Propinsi';
	$r->Name = 'id_loc_province';
	$r->ItemSelected = $Provinsi;
	$r->Mandatory = false;
	$r->FromQuery($db, "
		SELECT id AS id, name AS name 
		FROM `loc_province`"
	 );
	$r->AddValidator(new ComboBoxValidator($r));
	$Form->AddRowElement($r);
	
    $r = $Gui->MakeLabel();
	$Form->AddRowElement($r);

    $r = $Gui->MakeBottomButton();
	$r->OnClickMenu = clone($p->Child());
	$Form->AddRowElement($r);
	
	
	$Form->Action = new UpdateCityHandlerMenu();
	$Form->Action->IdCity = $p->IdCity; 
	$Form->Action->Next = new UpdateCityMenu();
	$Form->Action->Next->AddTail($p->Child());
		
	$Form->Display($p, $v);

  }
 
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>