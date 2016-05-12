<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertMasterLajurContent extends ContentInterface{
 
  public function InsertMasterLajurContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $Par = $this->Parent();
	$Conn = $Par->MakeDatabase();
    $Gui = $Par->MakeGuiFactory();

	$index = 0;
    $Row = array();
  	$Gui = $Par->MakeGuiFactory();
	$Form = $Gui->MakeForm();

	$Row[$index] = $Gui->MakeSubTitle();
	$Row[$index]->TextToDisplay = 'Tambah Master Lajur Jalan';	
	
   	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nama Lajur';
	$Row[$index]->Name = 'NamaLajur';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(255, 1));
	$Row[$index]->AddValidator(new CommonMasterTableNameValidator('mst_lajur',NULL));

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Deskripsi';
	$Row[$index]->Name = 'Deskripsi';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new StringLengthValidator(255, 1));

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Order';
	$Row[$index]->Name = 'Order';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));

	$index++;
	$Row[$index] = $Gui->MakeBottomButton();
	$Row[$index]->OnClickMenu = clone($Par->Child());
	
	$Form->Action = new InsertMasterLajurHandlerMenu();
	$Form->Action->Next = new UpdateMasterLajurMenu();
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