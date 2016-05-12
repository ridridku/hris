<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';
require_once FW_DIR . '/constant/ComboBox.cst.php';

class UpdateMasterJembatanContent extends ContentInterface{
	public function UpdateMasterJembatanContent(){
		ContentInterface::ContentInterface();
	}  
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		
		$QUERY = $Conn->Execute ("
			SELECT * 
			FROM mst_bridge 
			WHERE id = '". $Par->IDJembatan ."'
		");
		$Field = $Conn->FetchObject($QUERY);
		
		$index = 0;
		$Row = array();
		$Gui = $Par->MakeGuiFactory();
		$Form = $Gui->MakeForm();
		
		$Row[$index] = $Gui->MakeSubTitle();
		$Row[$index]->TextToDisplay = 'Edit Master Jembatan';
		$rsl = $Conn->Execute("
			SELECT * 
			FROM mst_ruas_jalan
			WHERE id = '" .($Par->Kode == NULL ? $Field->id__mst_ruas_jalan : $Par->Kode). "'
		");
		$R = $Conn->FetchObject($rsl);

		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = NULL;
		$Row[$index]->Name = 'Jarak';
			
		$index++;
		$SearchMasterRuasJalan = new SearchMasterRuasJalanMenu();
		$SearchMasterRuasJalan->AddTail($this->Parent());
		$Row[$index] = $Gui->MakeRefLabel();
		$Row[$index]->Name = 'NamaRuasjalan';
		$Row[$index]->TextToDisplay = 'Nama Ruas jalan';
		$Row[$index]->ButtonValue = 'Cari';
		$Row[$index]->Value = $R->nama_ruas;
		$Row[$index]->Mandatory = true;
		$Row[$index]->Link = $SearchMasterRuasJalan->Ref();
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'ID Jembatan';
		$Row[$index]->Name = 'IDJembatan';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = 16;
		$Row[$index]->Value = $Field->id;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new StringLengthValidator(32, 1));
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Nama Jembatan';
		$Row[$index]->Name = 'NamaJembatan';
		$Row[$index]->Size = 32;
		$Row[$index]->Maxlength = 32;
		$Row[$index]->Value = $Field->nama;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new StringLengthValidator(255, 1));
		
		$index++;
		$Row[$index] = $Gui->MakeComboBox();
		$Row[$index]->Name = 'id_mst_kabupaten_or_kodya';
		$Row[$index]->TextToDisplay = 'Kabupaten/Kota';
		$Row[$index]->ItemSelected = $Field->id_mst_kabupaten_or_kodya;
		$Row[$index]->FromQuery($Conn,"
			SELECT 
				id AS id, 
				name AS name
			FROM mst_kabupaten_or_kodya
			WHERE
				id_mst_propinsi = '".$R->id__mst_propinsi."'
			ORDER BY id
		");	
		$Row[$index]->Mandatory = false;
		$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
		
		$index++;
		$Row[$index] = $Gui->MakeComboBox();
		$Row[$index]->Name = 'DariLokasi';
		$Row[$index]->TextToDisplay = 'Dari Lokasi';
		$Row[$index]->ItemSelected = $Field->dari_lokasi;
		$Row[$index]->FromQuery($Conn,"
			SELECT 
				id AS id, 
				nama AS name
			FROM mst_kota
			ORDER BY id
		");	
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'KM Pos';
		$Row[$index]->Name = 'km_pos';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->km_pos;
		$Row[$index]->Mandatory = false;
		$Row[$index]->AddValidator(new FloatValidator());
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'SFFX';
		$Row[$index]->Name = 'SFFX';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->sffx;
		$Row[$index]->Mandatory = false;
		$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
		
		$index++;
		$Row[$index] = $Gui->MakeComboBox();
		$Row[$index]->Name = 'TipeLintasan';
		$Row[$index]->TextToDisplay = 'Tipe Lintasan';
		$Row[$index]->ItemSelected = $Field->id__mst_bridge_tipe_lintasan;
		$Row[$index]->FromQuery($Conn,"
			SELECT 
				id AS id, 
				nama AS name
			FROM mst_bridge_tipe_lintasan
			ORDER BY id
		");	
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
		
		$index++;
		$Row[$index] = $Gui->MakeComboBox();
		$Row[$index]->Name = 'id_mst_type_bridge';
		$Row[$index]->TextToDisplay = 'Type Jembatan';
		$Row[$index]->ItemSelected = $Field->id_mst_type_bridge;		
		$Row[$index]->FromQuery($Conn,"
			SELECT 
				id AS id, 
				nama AS name
			FROM mst_type_bridge
			ORDER BY id
		");	
		$Row[$index]->Mandatory = false;
		$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = NULL;
		$Row[$index]->Name = 'Jarak';
		$Row[$index]->Mandatory = FALSE;
		
		$index++;
		$Row[$index] = $Gui->MakeSubTitle();
		$Row[$index]->TextToDisplay = 'STA';
		$Row[$index]->Name = 'STA';
		$Row[$index]->Mandatory = FALSE;
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Bentang';
		$Row[$index]->Name = 'Bentang';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Value = $Field->bentang;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Panjang';
		$Row[$index]->Name = 'Panjang';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Value = $Field->panjang;
		$Row[$index]->Attribute = 'M';
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Lebar';
		$Row[$index]->Name = 'Lebar';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Value = $Field->lebar;
		$Row[$index]->Attribute = 'M';
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Tahun Bangunan';
		$Row[$index]->Name = 'TahunBangunan';
		$Row[$index]->Size = 5;
		$Row[$index]->Maxlength = 5;
		$Row[$index]->Value = $Field->tahun_bangun;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new IntegerValidator(1, 20000));
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Tipe Struktur Bangunan Atas';
		$Row[$index]->Name = 'TipeBA';
		$Row[$index]->Size = 32;
		$Row[$index]->Maxlength = 32;
		$Row[$index]->Value = $Field->tipe_ba;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Tipe Struktur Bangunan Bawah';
		$Row[$index]->Name = 'TipeBB';
		$Row[$index]->Size = 32;
		$Row[$index]->Maxlength = 32;
		$Row[$index]->Value = $Field->tipe_bb;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Status';
		$Row[$index]->Name = 'Status';
		$Row[$index]->Size = 32;
		$Row[$index]->Maxlength = 32;
		$Row[$index]->Value = $Field->status;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
		
		$index++;
		$Row[$index] = $Gui->MakeSubTitle();
		$Row[$index]->TextToDisplay = 'POSISI GPS';
		$Row[$index]->Name = 'POSISI GPS';
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'GPS Latitude';
		$Row[$index]->Name = 'GPS Latitude';
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Awal';
		$Row[$index]->Name = 'AwalGPSLat';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->start_gps_lat;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Akhir';
		$Row[$index]->Name = 'AkhirGPSLat';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->end_gps_lat;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'GPS Longitude';
		$Row[$index]->Name = 'GPS Longitude';
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Awal';
		$Row[$index]->Name = 'AwalGPSLong';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->start_gps_lon;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Akhir';
		$Row[$index]->Name = 'AkhirGPSLong';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->end_gps_lon;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'GPS Alt';
		$Row[$index]->Name = 'GPS Alt';
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Awal';
		$Row[$index]->Name = 'AwalGPSAlt';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->start_gps_alt;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Akhir';
		$Row[$index]->Name = 'AkhirGPSAlt';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->end_gps_alt;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'GPS Elevent';
		$Row[$index]->Name = 'GPS Elevent';
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Awal';
		$Row[$index]->Name = 'AwalGPSElev';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->start_gps_elev;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Akhir';
		$Row[$index]->Name = 'AkhirGPSElev';
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Value = $Field->end_gps_elev;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
		
		#keterangan tambahan
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = '';
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Jumlah Pier';
		$Row[$index]->Name = 'jml_pier';
		$Row[$index]->Value = $Field->jml_pier;
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Attribute = 'Buah';	
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Jarak Pier-Abutmen';
		$Row[$index]->Name = 'jarak_pier_abutmen';
		$Row[$index]->Value = $Field->jarak_pier_abutmen;
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Attribute = 'm';	
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Jarak Pier-Pier';
		$Row[$index]->Name = 'jarak_pier_pier';
		$Row[$index]->Value = $Field->jarak_pier_pier;
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Attribute = 'm';	
		$Row[$index]->Mandatory = FALSE;	
		$Row[$index]->AddValidator(new FloatValidator());	
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Lebar Median';
		$Row[$index]->Name = 'lebar_median';
		$Row[$index]->Value = $Field->lebar_median;
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Attribute = 'm';
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Lebar Trotoir';
		$Row[$index]->Name = 'lebar_trotoir';
		$Row[$index]->Value = $Field->lebar_trotoir;
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Attribute = 'm';
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Lebar Perkerasan';
		$Row[$index]->Name = 'lebar_perkerasan';
		$Row[$index]->Value = $Field->lebar_perkerasan;
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 16;
		$Row[$index]->Attribute = 'm';
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Ukuran Bahu Jalan';
		$Row[$index]->Name = 'bahu_jalan';
		$Row[$index]->Value = $Field->bahu_jalan;
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 13;
		$Row[$index]->Attribute = 'm';
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Clearance';
		$Row[$index]->Name = 'clearance';
		$Row[$index]->Value = $Field->clearance;
		$Row[$index]->Size = 16;
		$Row[$index]->Maxlength = 13;
		$Row[$index]->Attribute = 'm';
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());	
	
		$index++;
		$Row[$index] = $Gui->MakeTextArea();
		$Row[$index]->Name = 'keterangan';
		$Row[$index]->TextToDisplay = 'Deskripsi Kondisi Jembatan';
		$Row[$index]->Value = $Field->keterangan;
		$Row[$index]->Column = 64;
		$Row[$index]->Rows = 3;
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new StringLengthValidator(0xFFFFFFFFFFFF, 0));	
	
		
	
		$index++;
		$Row[$index] = $Gui->MakeBottomButton();
		$Row[$index]->OnClickMenu = clone($Par->Child());	
		
		$Form->Action = new UpdateMasterJembatanHandlerMenu();
		$Form->Action->IDJembatan = $Par->IDJembatan;
		$Form->Action->Kode = ($Par->Kode == NULL ? $Field->id__mst_ruas_jalan : $Par->Kode);
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