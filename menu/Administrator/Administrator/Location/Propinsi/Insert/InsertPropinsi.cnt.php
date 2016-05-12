<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertPropinsiContent extends ContentInterface
{
  const RowCek = 0;
  
  public function InsertPropinsiContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $Gui = $p->MakeGuiFactory();

	$Form = $Gui->MakeForm();
	$Form->FormName = 'DataLocationPropinsi';

	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Tambah Location Propinsi';
	$Form->AddRowElement($r);

   	$r = $Gui->MakeTextBox();
	$r->TextToDisplay = 'Id';
	$r->Name = 'IdPropinsi';
	$r->Size = 20;
	$r->Maxlength = 20;
    $r->Mandatory = TRUE;
	$r->AddValidator(new StringLengthValidator(20, 1));
	$r->AddValidator(new CommonMasterTableIdValidator('mst_propinsi',NULL));
	$Form->AddRowElement($r);
	
	
	$r = $Gui->MakeTextArea();
	$r->TextToDisplay = 'Nama';
	$r->Name = 'name';
	$r->Size = 20;
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
	
	$Form->Action = new InsertPropinsiHandlerMenu();
	$Form->Action->Next = new UpdatePropinsiMenu();
	$Form->Action->Next->AddTail($p->Child());
		
	$Form->Display($p, $v);
	
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>