<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertPaketKegiatanContent extends ContentInterface{
 
  public function InsertPaketKegiatanContent(){
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
	$Row[$index]->TextToDisplay = 'Tambah Paket Kegiatan';
	
	$index++;
   	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'jarak';
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'ID Satuan Kerja';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 10;
	$Row[$index]->Maxlength = 10;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'ID Pelaksana Kegiatan';
	$Row[$index]->Name = 'IDPelaksana';
	$Row[$index]->Size = 10;
	$Row[$index]->Maxlength = 10;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';
	
	$index++;
   	$Row[$index] = $Gui->MakeSubTitle();
	$Row[$index]->TextToDisplay = 'PAKET KEGIATAN';
	$Row[$index]->Name = 'IDSatuanKerja';
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Paket ID';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 5;
	$Row[$index]->Maxlength = 5;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Tahun Anggaran';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 5;
	$Row[$index]->Maxlength = 5;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nama Paket';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Jenis Pekerjaan';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Tipe Kontrak';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Panjang Efektif';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 5;
	$Row[$index]->Maxlength = 5;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Panjang Fungsional';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 5;
	$Row[$index]->Maxlength = 5;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';
	
	$index++;
   	$Row[$index] = $Gui->MakeSubTitle();
	$Row[$index]->TextToDisplay = 'SUMBER DANA';
	$Row[$index]->Name = 'IDSatuanKerja';
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Dana APBN';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Dana PLN';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Adendum APBN';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Adendum PLN';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Sumber Pinjaman Luar Negeri';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nomor';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 10;
	$Row[$index]->Maxlength = 10;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';
	
	$index++;
   	$Row[$index] = $Gui->MakeSubTitle();
	$Row[$index]->TextToDisplay = 'KONTRAK';
	$Row[$index]->Name = 'KONTRAK';
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nomor Kontrak';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeDatePicker();
	$Row[$index]->TextToDisplay = 'Tanggal Kontrak';
	$Row[$index]->Name = 'IDSatuanKerja';
    $Row[$index]->Mandatory = TRUE;
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nilai Kontrak';
	$Row[$index]->Name = 'IDSatuanKerja';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
	
	$index++;
   	$Row[$index] = $Gui->MakeDatePicker();
	$Row[$index]->TextToDisplay = 'Tanggal SPMK';
	$Row[$index]->Name = 'IDPaketKegiatan';
    $Row[$index]->Mandatory = TRUE;
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Masa Pelaksana';
	$Row[$index]->Name = 'NamaPelaksanakegiatan';
	$Row[$index]->Size = 5;
	$Row[$index]->Maxlength = 5;
	$Row[$index]->Attribute = 'Hari';
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Masa Pemeliharaan';
	$Row[$index]->Name = 'TahunAnggaran';
	$Row[$index]->Size = 5;
	$Row[$index]->Maxlength = 5;
	$Row[$index]->Attribute = 'Hari';
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));

   	$index++;
	$Row[$index] = $Gui->MakeDatePicker();
	$Row[$index]->TextToDisplay = 'Tanggal PHO';
	$Row[$index]->Name = 'TahunAnggaran';
    $Row[$index]->Mandatory = TRUE;

   	$index++;
	$Row[$index] = $Gui->MakeDatePicker();
	$Row[$index]->TextToDisplay = 'Tanggal FHO';
	$Row[$index]->Name = 'TahunAnggaran';
    $Row[$index]->Mandatory = TRUE;

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Kontraktor';
	$Row[$index]->Name = 'TahunAnggaran';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Konsultan';
	$Row[$index]->Name = 'TahunAnggaran';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	
	$index++;
	$Row[$index] = $Gui->MakeBottomButton();
	$Row[$index]->OnClickMenu = clone($Par->Child());
	
	$Form->Action = new InsertPaketKegiatanHandlerMenu();
	$Form->Action->Next = new UpdatePaketKegiatanMenu();
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