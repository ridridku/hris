<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class UpdateMasterKotaContent extends ContentInterface{
 
  public function UpdateMasterKotaContent(){
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
	$Row[$index]->TextToDisplay = 'Edit Nama Kota';	
	
	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = '';

	$QUERY = $Conn->Execute ("
		SELECT * 
		FROM mst_kota
		WHERE id = '". $Par->id ."'
	");
	$Field = $Conn->FetchObject($QUERY);

	/*$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Kode';
	$Row[$index]->Name = 'id';
	$Row[$index]->Size = 5;
	$Row[$index]->Maxlength = 5;
    $Row[$index]->Mandatory = true;
	$Row[$index]->Value = $Field->id;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	$Row[$index]->AddValidator(new CommonMasterTableValidator('mst_kota', $Par->id));
	*/
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nama Kota';
	$Row[$index]->Name = 'nama';
	$Row[$index]->Size = 64;
	$Row[$index]->Maxlength = 64;
	$Row[$index]->Value = $Field->nama;	
    $Row[$index]->Mandatory = true;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));

	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'id__mst_propinsi';
	$Row[$index]->TextToDisplay = 'Propinsi';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_propinsi
		ORDER BY id
	");	
	$Row[$index]->ItemSelected = $Field->id__mst_propinsi;
	$Row[$index]->Mandatory = true;
	$Row[$index]->AddValidator(new DefaultValidator());

	$index++;
	$Row[$index] = $Gui->MakeBottomButton();
	$Row[$index]->OnClickMenu = clone($Par->Child());
	
	$Form->Action = new UpdateMasterKotaHandlerMenu();	
	$Form->Action->id = $Par->id;
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