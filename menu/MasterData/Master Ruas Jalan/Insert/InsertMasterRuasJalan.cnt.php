<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertMasterRuasJalanContent extends ContentInterface{
 
  public function InsertMasterRuasJalanContent(){
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
	$Row[$index]->TextToDisplay = 'Tambah Master Ruas Jalan';	
	
	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';

	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Kode';
	$Row[$index]->Name = 'Kode';
	$Row[$index]->Size = 10;
	$Row[$index]->Maxlength = 10;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(16, 1));
	$Row[$index]->AddValidator(new CommonMasterTableValidator('mst_satker', NULL));
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Ruas';
	$Row[$index]->Name = 'Ruas';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));

	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'SSFX';
	$Row[$index]->Name = 'SSFX';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Kota';
	$Row[$index]->Name = 'Kota';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nama Ruas';
	$Row[$index]->Name = 'NamaRuas';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));

	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Lokasi';
	$Row[$index]->Name = 'Lokasi';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));

	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Dari Kilometer';
	$Row[$index]->Name = 'KMFrom';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
	$Row[$index]->Attribute = 'KM';
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());

	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Sampai Kilometer';
	$Row[$index]->Name = 'KMTo';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
	$Row[$index]->Attribute = 'KM';
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());

	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';

	$index++;
	$Row[$index] = $Gui->MakeSubTitle();
	$Row[$index]->TextToDisplay = 'LOKASI';

	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Panjang Ruas';
	$Row[$index]->Name = 'PanjangRuas';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
	$Row[$index]->Attribute = 'KM';
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());

	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Lebar Ruas';
	$Row[$index]->Name = 'LebarRuas';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
	$Row[$index]->Attribute = 'M';
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());

	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Panjang Berdasarkan Keputusan Mentri';
	$Row[$index]->Name = 'kepmen';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
	$Row[$index]->Attribute = 'KM';
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));

	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'AADT';
	$Row[$index]->Name = 'AADT';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));

	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Awal Ruas';
	$Row[$index]->Name = 'AwalJalan';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));

	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Akhir Ruas';
	$Row[$index]->Name = 'AkhirJalan';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'MST';
	$Row[$index]->Name = 'MST';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'BalaiBesar';
	$Row[$index]->TextToDisplay = 'Balai Besar';
	$Row[$index]->ItemSelected = '1';
	$Row[$index]->OnChange = "
			  for(var i=0; i<this.childNodes.length; i++){
				 oneChild = this.childNodes[i];
				 if(oneChild.selected){
					this.AccessUrl('?Menu=' + oneChild.OnChangeMenu);
					return;
				 }
	}";
	$rsl = $Conn->Execute("
		SELECT 
			id AS id, 
			nama AS nama
		FROM mst_balaibesar
		ORDER BY id
	");
	$i = 0;
    while($R = $Conn->FetchObject($rsl)){
		$m = new RequestCandidatePropinsiMenu();
		$m->Kode = $R->id;
		$Row[$index]->Result[$i][ComboBoxConstant::Title] = "
			this.OnChangeMenu = '" . $m->Ref() ."';
		";
		$Row[$index]->Result[$i][ComboBoxConstant::Value] = $R->id;
		$Row[$index]->Result[$i][ComboBoxConstant::Label] = $R->nama;
		$Row[$index]->Result[$i][ComboBoxConstant::Output] = $R->nama;
		$i++;
    }
	$Row[$index]->Mandatory = false;
	$Row[$index]->AddValidator(new DefaultValidator());

	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'Propinsi';
	$Row[$index]->TextToDisplay = 'Propinsi';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_propinsi
		WHERE mst_propinsi.id__mst_balaibesar = 1
		ORDER BY id
	");	
	$Row[$index]->Title = "
		this.HandleReceiveString[this.HandleReceiveString.length] = function(sender, txt){
			if(txt.Id == 'RequestCandidatePropinsiMenu'){
				while(sender.length > 0)sender.remove(0);
				if(txt.nama != null){
					for(var i=0; i<txt.nama.length; i++){
						var elm_select = document.createElement('option');
						elm_select.label = (txt.nama[i]);
						elm_select.value = txt.single_id[i];
						elm_select.text = (txt.nama[i]); 
						sender.add(elm_select, null);
					}
				}	
			}
			return true;
		};
	";
	$Row[$index]->Mandatory = false;
	$Row[$index]->AddValidator(new DefaultValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'Status';
	$Row[$index]->TextToDisplay = 'Status';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_status_jalan
		ORDER BY id
	");	
	$Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));

	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'Fungsi';
	$Row[$index]->TextToDisplay = 'Fungsi';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_fungsi
		ORDER BY id
	");	
	$Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));

	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'Lintas';
	$Row[$index]->TextToDisplay = 'Lintas';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_lintas
		ORDER BY id
	");	
	$Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));

	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'TipeJalan';
	$Row[$index]->TextToDisplay = 'Tipe Jalan';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_tipe_jalan
		ORDER BY id
	");	
	$Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
	
	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));

	$index++;
	$Row[$index] = $Gui->MakeSubTitle();
	$Row[$index]->TextToDisplay = 'POSISI';
	$Row[$index]->Name = 'POSISI';
	
	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = 'Bujur Timur (BT)';
	$Row[$index]->Name = 'Bujur Timur (BT)';
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Awal';
	$Row[$index]->Name = 'AwalBT';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Akhir';
	$Row[$index]->Name = 'AkhirBT';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = 'Lintang Selatan (LS)';
	$Row[$index]->Name = 'Lintang Selatan (LS)';
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Awal';
	$Row[$index]->Name = 'AwalLS';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Akhir';
	$Row[$index]->Name = 'AkhirLS';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = 'Tinggi';
	$Row[$index]->Name = 'Tinggi';
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Awal';
	$Row[$index]->Name = 'AwalTinggi';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
	$Row[$index]->Attribute = 'M';
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Akhir';
	$Row[$index]->Name = 'Akhirtinggi';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
	$Row[$index]->Attribute = 'M';
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';

	$index++;
	$Row[$index] = $Gui->MakeSubTitle();
	$Row[$index]->TextToDisplay = 'KETERANGAN';
	$Row[$index]->Name = 'KETERANGAN';
	
   	$index++;
	$Row[$index] = $Gui->MakeTextArea();
	$Row[$index]->TextToDisplay = 'Keterangan';
	$Row[$index]->Name = 'Keterangan';
	$Row[$index]->Column = 64;
	$Row[$index]->Rows = 4;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new StringLengthValidator(255, 1));

	$index++;
	$Row[$index] = $Gui->MakeBottomButton();
	$Row[$index]->OnClickMenu = clone($Par->Child());
	
	$Form->Action = new InsertMasterRuasJalanHandlerMenu();
	$Form->Action->Next = new UpdateMasterRuasJalanMenu();
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