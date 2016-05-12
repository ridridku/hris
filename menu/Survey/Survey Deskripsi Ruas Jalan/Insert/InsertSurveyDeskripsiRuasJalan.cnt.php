<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertSurveyDeskripsiRuasJalanContent extends ContentInterface{
	public function InsertSurveyDeskripsiRuasJalanContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		$Gui = $Par->MakeGuiFactory();

		$Form = $Gui->MakeForm();
		$Form->FormName = 'Data Location Survey Deskripsi Jalan';
	
		$index = 0;
		$Row = array();
		$Gui = $Par->MakeGuiFactory();
		$Form = $Gui->MakeForm();
	
		$Row[$index] = $Gui->MakeSubTitle();
		$Row[$index]->TextToDisplay = 'Tambah Data Survey Ruas Jalan';	
	
		$rsl = $Conn->Execute("
			SELECT * 
			FROM mst_ruas_jalan
			WHERE id = '" . $Par->IdLocRoad . "'
		");
		$R = $Conn->FetchObject($rsl);
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = NULL;
		$Row[$index]->Name = 'Jarak';
			
		$index++;
		$SearchMasterRuasJalan = new LibSvyRoadMenu();
		$SearchMasterRuasJalan->AddTail($this->Parent());
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
		$Row[$index]->Link = $SearchMasterRuasJalan->Ref();	
		
		if(!(is_null($Par->TimeStamp))){
			$index++;
			$Row[$index] = $Gui->MakeLabel();
			$Row[$index]->TextToDisplay = 'Waktu Survey';
			$Row[$index]->FromQuery($Conn, "
				SELECT DT_IndonesiaDateTime('". $Par->TimeStamp ."') AS Value
			");
		}

		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Kilometer Awal';
		$Row[$index]->Name = 'Post';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new FloatValidator());
	
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Kilometer Akhir';
		$Row[$index]->Name = 'Offset';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new FloatValidator());
		$Row[$index]->AddValidator(new CekDataInputKmValidator(NULL,'Post',$Par->IdLocRoad ));
		
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Lebar';
		$Row[$index]->Name = 'Lebar';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Attribute = 'M';
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());
		
		$index++;
		$Row[$index] = $Gui->MakeComboBox();
		$Row[$index]->Name = 'NamaLajur';
		$Row[$index]->TextToDisplay = 'Nama Lajur';
		$Row[$index]->FromQuery($Conn,"
			SELECT 
				id AS id, 
				nama AS name
			FROM mst_lajur
			WHERE
				id IN(1,2,3,4)
			ORDER BY nama
		");	
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
		$Row[$index]->AddValidator(new CekSurveyDeskripsiRuasJalanValidator(NULL,$Par->IdLocRoad,$Par->TimeStamp,'Post', 'Offset'));
	
		$index++;
		$Row[$index] = $Gui->MakeBottomButton();
		$Row[$index]->OnClickMenu = clone($Par->Child());
		
		$Form->Action = new InsertSurveyDeskripsiRuasJalanHandlerMenu();
		$Form->Action->IdLocRoad = $Par->IdLocRoad;
		$Form->Action->TimeStamp = $Par->TimeStamp;
		$Form->Action->Next = new InsertSurveyDeskripsiRuasJalanMenu();
		$Form->Action->Next->AddTail($Par->Child());
	
		for($a=0; $a<count($Row); $a++){
		  $Form->AddRowElement($Row[$a]);
		}		
		$Form->Display($Par, $v);
	}
	public function Path(){return __FILE__;}
}
?>