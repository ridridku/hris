<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateSurveyRoadContent extends ContentInterface
{
  public function UpdateSurveyRoadContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $Gui = $p->MakeGuiFactory();
	$sql = "
		SELECT *
		FROM
			svy_ruas_jalan
		WHERE
			id__mst_ruas_jalan = '".$p->IdLocRoad."' AND
			time_stamp = '".$p->TimeStamp."'
	";
	$rsl = $db->Execute($sql);
	$Rec = $db->FetchObject($rsl);
	$TimeTemp = explode(' ',$Rec->time_stamp);
	$Tanggal = $TimeTemp[0];
	$Waktu = $TimeTemp[1];
	
	$Form = $Gui->MakeForm();
	$Form->FormName = 'Data SurveyRoad';
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Ubah Survey Ruas Jalan';
	$Form->AddRowElement($r);

  /* 	$r = $Gui->MakeComboBox();
	$r->TextToDisplay = 'Ruas Jalan';
	$r->Name = 'IdLocRoad';
	$r->ItemSelected = $p->IdLocRoad;
	$r->Mandatory = false;
	$r->FromQuery($db, "
		SELECT
			id AS id,
			nama_ruas AS name 
		FROM `mst_ruas_jalan`
	");
	$r->AddValidator(new ComboBoxValidator($r));
	$Form->AddRowElement($r);
	*/
	if($p->Kode == NULL)$p->Kode = $p->IdLocRoad;	
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
	$r->Link = $SearchMasterRuasJalan->Ref();
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeDatePicker();
	$r->TextToDisplay = 'Tanggal';
	$r->Name = 'tanggal';
	$r->Value = $Tanggal;
	$r->Mandatory = TRUE;
	$r->AddValidator(new DateNotNullValidator());
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeTextBox();
	$r->Name = 'waktu';
	$r->TextToDisplay = 'Waktu';
	$r->Value = $Waktu;
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
	$r->Value = $Rec->deskripsi;
	$r->Mandatory = false;
	$r->AddValidator(new StringLengthValidator(255, 0));
	$Form->AddRowElement($r);

    $r = $Gui->MakeBottomButton();
	$r->OnClickMenu = clone($p->Child());
	$Form->AddRowElement($r);
	
	$Form->Action = new UpdateSurveyRoadHandlerMenu();
	$Form->Action->IdLocRoad = $p->IdLocRoad; 
	$Form->Action->TimeStamp = $p->TimeStamp; 
	$Form->Action->Kode = $p->Kode; 
	$Form->Action->Next = new UpdateSurveyRoadMenu();
	$Form->Action->Next = clone($p->Child());
		
	$Form->Display($p, $v);
  }
  public function Path(){return __FILE__;}
}
?>