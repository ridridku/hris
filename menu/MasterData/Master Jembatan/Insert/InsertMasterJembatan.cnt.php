<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertMasterJembatanContent extends ContentInterface{
 
  public function InsertMasterJembatanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $g = $p->MakeGuiFactory();
	
  	$g = $p->MakeGuiFactory();
	$f = $g->MakeForm();

	$r = $g->MakeSubTitle();
	$r->TextToDisplay = 'Tambah Master Jembatan';		
	$f->AddRowElement($r);
	
	$rsl = $db->Execute("
		SELECT * 
		FROM mst_ruas_jalan
		WHERE id = '" . $p->Kode . "'
	");
	$R = $db->FetchObject($rsl);	
	
   	$r = $g->MakeLabel();
	$r->TextToDisplay = NULL;
	$r->Name = 'Jarak';	
	$f->AddRowElement($r);
    	
	$SearchMasterRuasJalan = new SearchMasterRuasJalanMenu();
	$SearchMasterRuasJalan->AddTail($this->Parent());
	$r = $g->MakeRefLabel();
	$r->Name = 'NamaRuasjalan';
	$r->TextToDisplay = 'Nama Ruas jalan';
	$r->ButtonValue = 'Cari';
	$r->Value = $R->nama_ruas;
	$r->Mandatory = true;
	$r->Link = $SearchMasterRuasJalan->Ref();	
	$f->AddRowElement($r);

   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'ID Jembatan';
	$r->Name = 'IDJembatan';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = TRUE;
	$r->AddValidator(new StringLengthValidator(32, 1));	
	$f->AddRowElement($r);

   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Nama Jembatan';
	$r->Name = 'NamaJembatan';
	$r->Size = 32;
	$r->Maxlength = 32;
    $r->Mandatory = TRUE;
	$r->AddValidator(new StringLengthValidator(255, 1));	
	$f->AddRowElement($r);
	if($R->id__mst_propinsi){
		$r = $g->MakeComboBox();
		$r->Name = 'id_mst_kabupaten_or_kodya';
		$r->TextToDisplay = 'Kabupaten/Kota';
		$r->FromQuery($db,"
			SELECT 
				id AS id, 
				name AS name
			FROM mst_kabupaten_or_kodya
			WHERE
				id_mst_propinsi = '".$R->id__mst_propinsi."'
			ORDER BY id
		");	
		$r->Mandatory = false;
		$r->AddValidator(new ComboBoxValidator($r));	
		$f->AddRowElement($r);
	}


	
	$r = $g->MakeComboBox();
	$r->Name = 'DariLokasi';
	$r->TextToDisplay = 'Dari Lokasi';
	$r->FromQuery($db,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_kota
		ORDER BY id
	");	
	$r->Mandatory = FALSE;
	$r->AddValidator(new ComboBoxValidator($r));	
	$f->AddRowElement($r);

   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'KM Pos';
	$r->Name = 'km_pos';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = false;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);

   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'SFFX';
	$r->Name = 'SFFX';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = false;
	$r->AddValidator(new StringLengthValidator(64, 1));	
	$f->AddRowElement($r);

	$r = $g->MakeComboBox();
	$r->Name = 'TipeLintasan';
	$r->TextToDisplay = 'Tipe Lintasan';
	$r->FromQuery($db,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_bridge_tipe_lintasan
		ORDER BY id
	");	
	$r->Mandatory = FALSE;
	$r->AddValidator(new ComboBoxValidator($r));	
	$f->AddRowElement($r);
	
	$r = $g->MakeComboBox();
	$r->Name = 'id_mst_type_bridge';
	$r->TextToDisplay = 'Type Jembatan';
	$r->FromQuery($db,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_type_bridge
		ORDER BY id
	");	
	$r->Mandatory = false;
	$r->AddValidator(new ComboBoxValidator($r));	
	$f->AddRowElement($r);

   	$r = $g->MakeLabel();
	$r->TextToDisplay = NULL;
	$r->Name = 'Jarak';
    $r->Mandatory = FALSE;

   	$r = $g->MakeSubTitle();
	$r->TextToDisplay = 'STA';
	$r->Name = 'STA';
    $r->Mandatory = FALSE;	
	$f->AddRowElement($r);
	
   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Bentang';
	$r->Name = 'Bentang';
	$r->Size = 10;
	$r->Maxlength = 10;
    $r->Mandatory = FALSE;
	$r->AddValidator(new IntegerValidator(1, 20000));	
	$f->AddRowElement($r);

   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Panjang';
	$r->Name = 'Panjang';
	$r->Size = 10;
	$r->Maxlength = 10;
	$r->Attribute = 'M';
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);

   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Lebar';
	$r->Name = 'Lebar';
	$r->Size = 10;
	$r->Maxlength = 10;
    $r->Attribute = 'M';
	$r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);

   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Tahun Bangunan';
	$r->Name = 'TahunBangunan';
	$r->Size = 5;
	$r->Maxlength = 5;
    $r->Mandatory = FALSE;
	$r->AddValidator(new IntegerValidator(1, 20000));	
	$f->AddRowElement($r);

   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Tipe Struktur Bangunan Atas';
	$r->Name = 'TipeBA';
	$r->Size = 32;
	$r->Maxlength = 32;
    $r->Mandatory = FALSE;
	$r->AddValidator(new StringLengthValidator(64, 1));	
	$f->AddRowElement($r);

   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Tipe Struktur Bangunan Bawah';
	$r->Name = 'TipeBB';
	$r->Size = 32;
	$r->Maxlength = 32;
    $r->Mandatory = FALSE;
	$r->AddValidator(new StringLengthValidator(64, 1));	
	$f->AddRowElement($r);

   	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Status';
	$r->Name = 'Status';
	$r->Size = 32;
	$r->Maxlength = 32;
    $r->Mandatory = FALSE;
	$r->AddValidator(new StringLengthValidator(64, 1));	
	$f->AddRowElement($r);

	$r = $g->MakeSubTitle();
	$r->TextToDisplay = 'POSISI GPS';
	$r->Name = 'POSISI GPS';	
	$f->AddRowElement($r);
	
	$r = $g->MakeLabel();
	$r->TextToDisplay = 'GPS Latitude';
	$r->Name = 'GPS Latitude';	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Awal';
	$r->Name = 'AwalGPSLat';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Akhir';
	$r->Name = 'AkhirGPSLat';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());		
	$f->AddRowElement($r);

	$r = $g->MakeLabel();
	$r->TextToDisplay = 'GPS Longitude';
	$r->Name = 'GPS Longitude';	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Awal';
	$r->Name = 'AwalGPSLong';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Akhir';
	$r->Name = 'AkhirGPSLong';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());		
	$f->AddRowElement($r);
	
	$r = $g->MakeLabel();
	$r->TextToDisplay = 'GPS Alt';
	$r->Name = 'GPS Alt';	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Awal';
	$r->Name = 'AwalGPSAlt';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Akhir';
	$r->Name = 'AkhirGPSAlt';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());		
	$f->AddRowElement($r);
	
	$r = $g->MakeLabel();
	$r->TextToDisplay = 'GPS Elevent';
	$r->Name = 'GPS Elevent';	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Awal';
	$r->Name = 'AwalGPSElev';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Akhir';
	$r->Name = 'AkhirGPSElev';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());		
	$f->AddRowElement($r);
	
	
	
	#keterangan tambahan
	$r = $g->MakeLabel();
	$r->TextToDisplay = '';	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Jumlah Pier';
	$r->Name = 'jml_pier';
	$r->Size = 16;
	$r->Maxlength = 16;
	$r->Attribute = 'Buah';	
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Jarak Pier-Abutmen';
	$r->Name = 'jarak_pier_abutmen';
	$r->Size = 16;
	$r->Maxlength = 16;
	$r->Attribute = 'm';	
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Jarak Pier-Pier';
	$r->Name = 'jarak_pier_pier';
	$r->Size = 16;
	$r->Maxlength = 16;
	$r->Attribute = 'm';	
    $r->Mandatory = FALSE;	
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Lebar Median';
	$r->Name = 'lebar_median';
	$r->Size = 16;
	$r->Maxlength = 16;
	$r->Attribute = 'm';
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Lebar Trotoir';
	$r->Name = 'lebar_trotoir';
	$r->Size = 16;
	$r->Maxlength = 16;
	$r->Attribute = 'm';
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Lebar Perkerasan';
	$r->Name = 'lebar_perkerasan';
	$r->Size = 16;
	$r->Maxlength = 16;
	$r->Attribute = 'm';
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Ukuran Bahu Jalan';
	$r->Name = 'bahu_jalan';
	$r->Size = 16;
	$r->Maxlength = 13;
	$r->Attribute = 'm';
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Clearance';
	$r->Name = 'clearance';
	$r->Size = 16;
	$r->Maxlength = 13;
	$r->Attribute = 'm';
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextArea();
	$r->Name = 'keterangan';
	$r->TextToDisplay = 'Deskripsi Kondisi Jembatan';
	$r->Column = 64;
	$r->Rows = 3;
    $r->Mandatory = FALSE;
	$r->AddValidator(new StringLengthValidator(0xFFFFFFFFFFFF, 0));	
	$f->AddRowElement($r);
	
	
	
	
	
	$r = $g->MakeBottomButton();
	$r->OnClickMenu = clone($p->Child());
	$f->AddRowElement($r);
	
	$f->Action = new InsertMasterJembatanHandlerMenu();
	$f->Action->Kode = $p->Kode;
	$f->Action->Next = new UpdateMasterJembatanMenu();
	$f->Action->Next->AddTail($p->Child());

#	for($a=0; $a<count($Row); $a++){
#	  $f->AddRowElement($Row[$a]);
#	}		
	$f->Display($p, $v);
	
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>