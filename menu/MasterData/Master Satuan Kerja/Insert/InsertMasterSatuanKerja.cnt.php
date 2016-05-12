<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertMasterSatuanKerjaContent extends ContentInterface{
 
  public function InsertMasterSatuanKerjaContent(){
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
	$Row[$index]->TextToDisplay = 'Tambah Master Satuan Kerja';	
	
	$index++;
   	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Kode';
	$Row[$index]->Name = 'Kode';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(16, 1));
	$Row[$index]->AddValidator(new CommonMasterTableValidator('mst_satker', NULL));
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Nama';
	$Row[$index]->Name = 'Nama';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(32, 1));

   	$index++;
	$Row[$index] = $Gui->MakeTextArea();
	$Row[$index]->TextToDisplay = 'Alamat';
	$Row[$index]->Name = 'Alamat';
	$Row[$index]->Column = 64;
	$Row[$index]->Rows = 4;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(255, 1));

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
	$Row[$index]->Mandatory = true;
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
	$Row[$index]->Mandatory = true;
	$Row[$index]->AddValidator(new DefaultValidator());

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Email';
	$Row[$index]->Name = 'Email';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(255, 1));
	$Row[$index]->AddValidator(new EmailAddressValidator());

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Telp';
	$Row[$index]->Name = 'Telp';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	$Row[$index]->AddValidator(new MobilePhoneNumberValidator());

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Fax';
	$Row[$index]->Name = 'Fax';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	$Row[$index]->AddValidator(new HomePhoneNumberValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'TahunAnggaran';
	$Row[$index]->TextToDisplay = 'Tahun Anggaran';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_tahun_anggaran
		ORDER BY id
	");	
	$Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new DefaultValidator());

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Ketua';
	$Row[$index]->Name = 'Ketua';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'NIP Ketua';
	$Row[$index]->Name = 'NIPKetua';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Bendahara';
	$Row[$index]->Name = 'Bendahara';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'NIP Bendahara';
	$Row[$index]->Name = 'NIPBendahara';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Atasan';
	$Row[$index]->Name = 'Atasan';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'NIP Atasan';
	$Row[$index]->Name = 'NIPAtasan';
	$Row[$index]->Size = 32;
	$Row[$index]->Maxlength = 32;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new StringLengthValidator(64, 1));
	
	$index++;
	$Row[$index] = $Gui->MakeBottomButton();
	$Row[$index]->OnClickMenu = clone($Par->Child());
	
	$Form->Action = new InsertMasterSatuanKerjaHandlerMenu();
	$Form->Action->Next = new UpdateMasterSatuanKerjaMenu();
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