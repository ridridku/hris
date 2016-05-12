<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertMasterPropinsiContent extends ContentInterface{
 
  public function InsertMasterPropinsiContent(){
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
	$Row[$index]->TextToDisplay = 'Tambah Nama Propinsi';	
	
	/*$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Kode';
	$Row[$index]->Name = 'Kode';
	$Row[$index]->Size = 5;
	$Row[$index]->Maxlength = 5;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	$Row[$index]->AddValidator(new CommonMasterTableValidator('mst_propinsi', NULL));
	*/
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nama Propinsi';
	$Row[$index]->Name = 'NamaPropinsi';
	$Row[$index]->Size = 64;
	$Row[$index]->Maxlength = 64;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	$Row[$index]->AddValidator(new CommonMasterTableNameValidator('mst_propinsi',NULL));

	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'BalaiBesar';
	$Row[$index]->TextToDisplay = 'Balai Besar';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_balaibesar
		ORDER BY id
	");	
	$Row[$index]->Mandatory = true;
	$Row[$index]->AddValidator(new DefaultValidator());

	$index++;
	$Row[$index] = $Gui->MakeBottomButton();
	$Row[$index]->OnClickMenu = clone($Par->Child());
	
	$Form->Action = new InsertMasterPropinsiHandlerMenu();
	$Form->Action->Next = new UpdateMasterPropinsiMenu();
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