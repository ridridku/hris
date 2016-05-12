<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertPelaksanaKegiatanContent extends ContentInterface{
 
  public function InsertPelaksanaKegiatanContent(){
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
	$Row[$index]->TextToDisplay = 'Tambah Pelaksana Kegiatan';
	
	$index++;
   	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'jarak';

	$rsl = $Conn->Execute("
		SELECT * 
		FROM mst_satker
		WHERE id = '" . $Par->Kode . "'
	");
	$R = $Conn->FetchObject($rsl);	

	$index++;
	$SearchMasterSatuanKerja = new SearchMasterSatuanKerjaMenu();
	$SearchMasterSatuanKerja->AddTail($this->Parent());
	$Row[$index] = $Gui->MakeRefLabel();
	$Row[$index]->Name = 'NamaSatuanKerja';
	$Row[$index]->TextToDisplay = 'Nama Satuan Kerja';
	$Row[$index]->ButtonValue = 'Cari';
	$Row[$index]->Value = $R->nama;
	$Row[$index]->Mandatory = true;
	$Row[$index]->Link = $SearchMasterSatuanKerja->Ref();
	
	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'TahunAnggaran';
	$Row[$index]->TextToDisplay = 'Tahun Anggaran';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_tahun_anggaran
		ORDER BY id DESC 
	");	
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
	$Row[$index]->AddValidator(new CekPelaksanaKegiatanValidator(NULL, $Par->Kode));

	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'ID Pelaksana';
	$Row[$index]->Name = 'IDPelaksanaKegiatan';
	$Row[$index]->Size = 5;
	$Row[$index]->Maxlength = 5;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nama';
	$Row[$index]->Name = 'NamaPelaksanakegiatan';
	$Row[$index]->Size = 64;
	$Row[$index]->Maxlength = 64;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));

	$index++;
	$Row[$index] = $Gui->MakeBottomButton();
	$Row[$index]->OnClickMenu = clone($Par->Child());
	
	$Form->Action = new InsertPelaksanaKegiatanHandlerMenu();
	$Form->Action->Kode = $Par->Kode;	
	$Form->Action->Next = new UpdatePelaksanaKegiatanMenu();
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