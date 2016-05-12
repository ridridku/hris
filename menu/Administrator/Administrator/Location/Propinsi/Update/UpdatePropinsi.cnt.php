<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdatePropinsiContent extends ContentInterface
{
  public function UpdatePropinsiContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $Gui = $p->MakeGuiFactory();
	$sql = " SELECT *
			 FROM mst_propinsi
			 WHERE id = '".$p->IdPropinsi."'
	";
	$rsl = $db->Execute($sql);
	$r = $db->FetchObject($rsl);
	$Provinsi = $r->id__mst_balaibesar;
	$Name = $r->nama;
	
	$Form = $Gui->MakeForm();
	$Form->FormName = 'Data Propinsi';
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Update Propinsi';
	$Form->AddRowElement($r);

   	$r = $Gui->MakeTextBox();
	$r->TextToDisplay = 'Id';
	$r->Name = 'IdPropinsi';
	$r->Value = $p->IdPropinsi;
	$r->Size = 20;
	$r->Maxlength = 11;
    $r->Mandatory = TRUE;
	$r->AddValidator(new CommonMasterTableIdValidator('mst_propinsi', $p->IdPropinsi));
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
	$r->TextToDisplay = 'Balaibesar';
	$r->Name = 'Balaibesar';
	$r->Mandatory = false;
	$r->ItemSelected = $Provinsi;
	$r->FromQuery($db, "
		SELECT id AS id, nama AS name 
		FROM `mst_balaibesar`"
	 );
	$r->AddValidator(new ComboBoxValidator($r));
	$Form->AddRowElement($r);

    $r = $Gui->MakeLabel();
	$Form->AddRowElement($r);

    $r = $Gui->MakeBottomButton();
	$r->OnClickMenu = clone($p->Child());
	$Form->AddRowElement($r);
	
	
	$Form->Action = new UpdatePropinsiHandlerMenu();
	$Form->Action->IdPropinsi = $p->IdPropinsi; 
	$Form->Action->Next = new UpdatePropinsiMenu();
	$Form->Action->Next->AddTail($p->Child());
		
	$Form->Display($p, $v);

  }
 
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>