<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';
require_once FW_DIR . '/constant/ComboBox.cst.php';

class UpdateMasterPropinsiContent extends ContentInterface{
	public function UpdateMasterPropinsiContent(){
		ContentInterface::ContentInterface();
	}  
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		$sql = "
			SELECT * 
			FROM mst_propinsi 
			WHERE id = '". $Par->Kode ."' 
		";
		$rsl = $Conn->Execute($sql);
		$Field = $Conn->FetchObject($rsl);
		
		$index = 0;
		$Row = array();
		$Gui = $Par->MakeGuiFactory();
		$Form = $Gui->MakeForm();
		
		$Row[$index] = $Gui->MakeSubTitle();
		$Row[$index]->TextToDisplay = 'Edit Nama Propinsi';	
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Nama Propinsi';
		$Row[$index]->Name = 'NamaPropinsi';
		$Row[$index]->Value = $Field->nama;
		$Row[$index]->Size = 64;
		$Row[$index]->Maxlength = 64;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
		
		$index++;
		$Row[$index] = $Gui->MakeComboBox();
		$Row[$index]->Name = 'BalaiBesar';
		$Row[$index]->TextToDisplay = 'Balai Besar';
		$Row[$index]->ItemSelected = $Field->id__mst_balaibesar;
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
		
		$Form->Action = new UpdateMasterPropinsiHandlerMenu();
		$Form->Action->Kode = $Par->Kode;
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