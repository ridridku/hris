<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertSurveyRoadContent extends ContentInterface
{
  public function InsertSurveyRoadContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $Gui = $p->MakeGuiFactory();

	$Form = $Gui->MakeForm();
	$Form->FormName = 'Data Location Survey Road';
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Tambah Data Survey Ruas Jalan';
	$Form->AddRowElement($r);
	
	$SearchMasterRuasJalan = new SearchMasterRuasJalanMenu();
	$SearchMasterRuasJalan->AddTail($this->Parent());
	$r = $Gui->MakeRefLabel();
	$r->Name = 'NamaRuasjalan';
	$r->TextToDisplay = 'Nama Ruas jalan';
	$r->ButtonValue = 'Cari';
	$rsl = $db->Execute("
		SELECT * 
		FROM mst_ruas_jalan
		WHERE id = '" . $p->Kode . "'
	");
	$R = $db->FetchObject($rsl);
	$r->Value = $R->nama_ruas;
	$r->Mandatory = true;
	$r->AddValidator(new SearchIdPencarianValidator());		
	$r->Link = $SearchMasterRuasJalan->Ref();
	$Form->AddRowElement($r);

	
	
	
	$r = $Gui->MakeDatePicker();
	$r->TextToDisplay = 'Tanggal';
	$r->Name = 'tanggal';
	$r->Mandatory = TRUE;
	$r->AddValidator(new DateNotNullValidator());
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeTextBox();
	$r->Name = 'waktu';
	$r->TextToDisplay = 'Waktu';
	$r->Size = 10;
	$r->MaxLength = 8;
	$r->Attribute = '[00:00/Jam:Menit]';
	$r->AddValidator(new TimeFormatValidator());
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeTextArea();
	$r->Name = 'deskripsi';
	$r->TextToDisplay = 'Deskripsi';
	$r->Row = 3;
	$r->Column = 64;
	$r->Mandatory = false;
	$r->AddValidator(new StringLengthValidator(255, 0));
	$Form->AddRowElement($r);

    $r = $Gui->MakeBottomButton();
	$r->OnClickMenu = clone($p->Child());
	$Form->AddRowElement($r);
	
	$Form->Action = new InsertSurveyRoadHandlerMenu();
	$Form->Action->IdRuasJalan = $p->Kode;
	$Form->Action->Next = clone($p->Child());
		
	$Form->Display($p, $v);
  }
  public function Path(){return __FILE__;}
}
?>