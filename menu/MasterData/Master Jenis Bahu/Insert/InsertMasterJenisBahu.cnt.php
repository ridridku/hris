<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertMasterJenisBahuContent extends ContentInterface{
 
  public function InsertMasterJenisBahuContent(){
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
	$Row[$index]->TextToDisplay = 'Tambah Master Jenis Bahu';	
	
   	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nama Jenis Bahu';
	$Row[$index]->Name = 'NamaJenisBahu';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(255, 1));

	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'BahuGroup';
	$Row[$index]->TextToDisplay = 'Bahu Group';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_bahu_group
		ORDER BY id
	");	
	$Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
	
	$index++;
	$Row[$index] = $Gui->MakeBottomButton();
	$Row[$index]->OnClickMenu = clone($Par->Child());
	
	$Form->Action = new InsertMasterJenisBahuHandlerMenu();
	$Form->Action->Next = new UpdateMasterJenisBahuMenu();
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