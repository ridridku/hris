<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';
require_once FW_DIR . '/constant/ComboBox.cst.php';

class UpdatePaketKegiatanContent extends ContentInterface{
	public function UpdatePaketKegiatanContent(){
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
		$Row[$index]->TextToDisplay = 'Edit Paket Kegiatan';	
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = NULL;
		$Row[$index]->Name = 'jarak';
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'ID Satuan Kerja';
		$Row[$index]->Name = 'IDSatuanKerja';
		$Row[$index]->Size = 5;
		$Row[$index]->Maxlength = 5;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'ID Pelaksana';
		$Row[$index]->Name = 'IDPaketKegiatan';
		$Row[$index]->Size = 5;
		$Row[$index]->Maxlength = 5;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Nama';
		$Row[$index]->Name = 'NamaPelaksanakegiatan';
		$Row[$index]->Size = 64;
		$Row[$index]->Maxlength = 64;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Tahun Anggaran';
		$Row[$index]->Name = 'TahunAnggaran';
		$Row[$index]->Size = 5;
		$Row[$index]->Maxlength = 5;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
		
		$index++;
		$Row[$index] = $Gui->MakeBottomButton();
		$Row[$index]->OnClickMenu = clone($Par->Child());	
		
		$Form->Action = new UpdatePaketKegiatanHandlerMenu();
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