<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertSurveyKondisiTepiJalanContent extends ContentInterface{
  public function InsertSurveyKondisiTepiJalanContent(){
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
	$Row[$index]->TextToDisplay = 'Tambah Sutvey Kondisi Jalan';	
	
	$rsl = $Conn->Execute("
		SELECT * 
		FROM mst_ruas_jalan
		WHERE id = '" . $Par->SearchIDRuas . "'
	");
	$R = $Conn->FetchObject($rsl);	
	
   	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';
    	
	$index++;
	$SearchSurveyRuasJalan = new SearchSurveyRuasJalanMenu();
	$SearchSurveyRuasJalan->AddTail($this->Parent());
	$Row[$index] = $Gui->MakeRefLabel();
	$Row[$index]->Name = 'NamaRuasjalan';
	$Row[$index]->TextToDisplay = 'Nama Ruas jalan';
	$Row[$index]->ButtonValue = 'Cari';
	if($R->nama_ruas != NULL){
		$Row[$index]->Value = $R->nama_ruas;
	}else{
		$Row[$index]->Value = ' - ';
	}
	$Row[$index]->Mandatory = true;
	$Row[$index]->AddValidator(new SearchIdPencarianValidator());
	$Row[$index]->Link = $SearchSurveyRuasJalan->Ref();

	if(!(is_null($Par->SearchTimeStamp))){
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'Waktu Survey';
		$Row[$index]->FromQuery($Conn, "
			SELECT DT_IndonesiaDateTime('". $Par->SearchTimeStamp ."') AS Value
		");
	}
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Kilometer Awal';
	$Row[$index]->Name = 'Post';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new FloatValidator());

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Kilometer Akhir';
	$Row[$index]->Name = 'Offset';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new CekDataInputKmValidator(NULL,'Post', $Par->SearchIDRuas));
	$Row[$index]->AddValidator(new FloatValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'NamaLajur';
	$Row[$index]->TextToDisplay = 'Nama lajur';
	$Row[$index]->ItemSelected = $Par->IdRuasJalan;
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
			mst_lajur.id as id,
			 CONCAT(mst_lajur.nama,'  |  ',mst_lajur.deskripsi) as nama,
			mst_lajur.id__mst_bahu_group AS IdGroupBahu
	FROM
			mst_lajur			
	");

	$i = 0;
	while($R = $Conn->FetchObject($rsl)){
		$m = new RequestCandidateJenisBahuMenu();
		$m->IdGroupBahu = $R->IdGroupBahu;
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
	$Row[$index]->Name = 'JenisBahu';
	$Row[$index]->TextToDisplay = 'Jenis Bahu';
	$Row[$index]->FromQuery($Conn,"
		SELECT
			mst_jenis_bahu.id as id,
			mst_jenis_bahu.nama as name
		
		FROM
			mst_jenis_bahu
		WHERE
		   mst_jenis_bahu.id__mst_bahu_group =  '". (is_null($Par->IdGroup)?4:$p->$Par->IdGroup) ."'
		ORDER BY mst_jenis_bahu.nama 
	");
	$Row[$index]->Title = "
		this.HandleReceiveString[this.HandleReceiveString.length] = function(sender, txt){
			if(txt.Id == 'RequestCandidateJenisBahuMenu'){
				while(sender.length > 0)sender.remove(0);
				if(txt.nama != null){
					for(var i=0; i<txt.nama.length; i++){
						var elm_select = document.createElement('option');
						elm_select.label = (txt.nama[i]);
						elm_select.value = txt.id[i];
						elm_select.text = (txt.nama[i]); 
						sender.add(elm_select, null);
					}
				}	
			}
			return true;
		};
	";
	
	
	$Row[$index]->Mandatory = true;

	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'KondisiBahu';
	$Row[$index]->TextToDisplay = 'Kondisi Bahu';
	$Row[$index]->FromQuery($Conn,"
		SELECT 
			id AS id, 
			nama AS name
		FROM mst_kondisi_jalan
		ORDER BY id
	");	
	$Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
	
	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Lebar';
	$Row[$index]->Name = 'lebar';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());
	
	
	
#	penambahan 
		

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$index++;
	$Row[$index] = $Gui->MakeBottomButton();
	$Row[$index]->OnClickMenu = clone($Par->Child());
	
	$Form->Action = new InsertSurveyKondisiTepiJalanHandlerMenu();
	$Form->Action->SearchIDRuas = $Par->SearchIDRuas;
	$Form->Action->SearchTimeStamp = $Par->SearchTimeStamp;
//	$Form->Action->Next = new UpdateSurveyKondisiTepiJalanMenu();
//	$Form->Action->Next->AddTail($Par->Child());
	$Form->Action->Next = clone($Par);

	for($a=0; $a<count($Row); $a++){
	  $Form->AddRowElement($Row[$a]);
	}		
	$Form->Display($Par, $v);
	
  }
  public function Path(){return __FILE__;}
}
?>