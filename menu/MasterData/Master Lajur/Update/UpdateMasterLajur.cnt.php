<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';
require_once FW_DIR . '/constant/ComboBox.cst.php';

class UpdateMasterLajurContent extends ContentInterface{
	public function UpdateMasterLajurContent(){
		ContentInterface::ContentInterface();
	}  
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		
		$QUERY = $Conn->Execute ("
			SELECT *
			FROM mst_lajur
			WHERE id = '". $Par->IDLajur ."'
		");
		$Field = $Conn->FetchObject($QUERY);
		
		$index = 0;
		$Row = array();
		$Gui = $Par->MakeGuiFactory();
		$Form = $Gui->MakeForm();
		
		$Row[$index] = $Gui->MakeSubTitle();
		$Row[$index]->TextToDisplay = 'Edit Master Lajur Jalan';
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = NULL;
		$Row[$index]->Name = 'Jarak';
			
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'ID Lajur';
		$Row[$index]->Name = 'IDLajur';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->id;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
		$Row[$index]->AddValidator(new CommonMasterTableValidator('mst_lajur', $Field->id));
	
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Nama Lajur';
		$Row[$index]->Name = 'NamaLajur';
		$Row[$index]->Size = 32;
		$Row[$index]->Maxlength = 32;
		$Row[$index]->Value = $Field->nama;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new StringLengthValidator(255, 1));
	
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Deskripsi';
		$Row[$index]->Name = 'Deskripsi';
		$Row[$index]->Size = 32;
		$Row[$index]->Maxlength = 32;
		$Row[$index]->Value = $Field->deskripsi;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new StringLengthValidator(255, 1));
	
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Order';
		$Row[$index]->Name = 'Order';
		$Row[$index]->Size = 32;
		$Row[$index]->Maxlength = 32;
		$Row[$index]->Value = $Field->order;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
		$index++;
		$Row[$index] = $Gui->MakeBottomButton();
		$Row[$index]->OnClickMenu = clone($Par->Child());	
		
		$Form->Action = new UpdateMasterLajurHandlerMenu();
		$Form->Action->IDLajur = $Par->IDLajur;
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