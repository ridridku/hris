<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';
require_once FW_DIR . '/constant/ComboBox.cst.php';

class UpdatePelaksanaKegiatanContent extends ContentInterface{
	public function UpdatePelaksanaKegiatanContent(){
		ContentInterface::ContentInterface();
	}  
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		
		$SQL = "
			SELECT * 
			FROM mst_pelaksana_kegiatan
			WHERE 
				id__mst_satker = '" . $Par->IdSatker ."' AND
				id__mst_tahun_anggaran = '". $Par->IdTahun ."'
		";
		$rsl = $Conn->Execute($SQL);
		$Field = $Conn->FetchObject($rsl);
		
		$index = 0;
		$Row = array();
		$Gui = $Par->MakeGuiFactory();
		$Form = $Gui->MakeForm();
		
		$Row[$index] = $Gui->MakeSubTitle();
		$Row[$index]->TextToDisplay = 'Edit Pelaksana Kegiatan';	
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = NULL;
		$Row[$index]->Name = 'jarak';
		
		if($Par->Kode == NULL){
			$rsl = $Conn->Execute("
				SELECT * 
				FROM mst_satker
				WHERE id = '" . $Field->id__mst_satker . "'
			");		
		}else{
			$rsl = $Conn->Execute("
				SELECT * 
				FROM mst_satker
				WHERE id = '" . $Par->Kode . "'
			");		
		}
			$R = $Conn->FetchObject($rsl);	
	
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->Name = 'NamaSatuanKerja';
		$Row[$index]->TextToDisplay = 'Nama Satuan Kerja';
		$Row[$index]->ButtonValue = 'Cari';
		$Row[$index]->Value = $R->nama;
		$Row[$index]->Mandatory = true;
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->Name = 'TahunAnggaran';
		$Row[$index]->TextToDisplay = 'Tahun Anggaran';
		$Row[$index]->ButtonValue = 'Cari';
		$Row[$index]->FromQuery($Conn,"
			SELECT 
				id AS id, 
				nama AS Value
			FROM mst_tahun_anggaran
			WHERE
				id = '". $Field->id__mst_tahun_anggaran ."'
			ORDER BY id DESC 
		");
		$Row[$index]->Mandatory = true;
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'ID Pelaksana';
		$Row[$index]->Name = 'IDPelaksanaKegiatan';
		$Row[$index]->Size = 5;
		$Row[$index]->Maxlength = 5;
		$Row[$index]->Value = $Field->id_pelaksana;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Nama';
		$Row[$index]->Name = 'NamaPelaksanakegiatan';
		$Row[$index]->Size = 64;
		$Row[$index]->Maxlength = 64;
		$Row[$index]->Value = $Field->nama;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
		
		$index++;
		$Row[$index] = $Gui->MakeBottomButton();
		$Row[$index]->OnClickMenu = clone($Par->Child());	
		
		$Form->Action = new UpdatePelaksanaKegiatanHandlerMenu();
		$Form->Action->IdTahun = $Par->IdTahun;
		$Form->Action->IdSatker = $Par->IdSatker;
		if($Par->Kode == NULL){
			$Form->Action->Kode = $Field->id__mst_satker;
		}else{
			$Form->Action->Kode = $Par->Kode;
		}
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