<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateSurveyDeskripsiRuasJalanContent extends ContentInterface{
	public function UpdateSurveyDeskripsiRuasJalanContent(){
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
		$Row[$index]->TextToDisplay = 'Edit Survey Deskripsi Jalan';
		
		$Query = $Conn->Execute("
			SELECT *,
				DT_IndonesiaDateTime(svy_deskripsi_ruas_jalan.timestamp) AS TimeSurvey
			FROM svy_deskripsi_ruas_jalan
			WHERE
				id__mst_ruas_jalan = '". $Par->IDRuas ."' AND
				timestamp = '". $Par->WaktuSurvey ."' AND
				post = '". $Par->Post ."' AND
				offset = '". $Par->Offset ."' AND
				id__mst_lajur = '". $Par->IdLajur ."'								
		");
		$Result = $Conn->FetchObject($Query);
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = NULL;
		$Row[$index]->Name = 'Jarak';
			
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'Nama Ruas jalan';
		$Row[$index]->Name = 'Nama Ruas jalan';
		$Row[$index]->FromQuery($Conn,"
			SELECT 
				id AS id, 
				nama_ruas AS Value
			FROM mst_ruas_jalan
			WHERE mst_ruas_jalan.id = '". $Par->IDRuas ."'
		");
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'Waktu Survey';
		$Row[$index]->Name = 'WaktuSurvey';
		$Row[$index]->Value =  $Par->WaktuSurvey;
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Kilometer Awal';
		$Row[$index]->Name = 'Post';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Value = $Par->Post;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new FloatValidator());
	
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Kilometer Akhir';
		$Row[$index]->Name = 'Offset';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Value = $Par->Offset;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new FloatValidator());
		$Row[$index]->AddValidator(new CekDataInputKmValidator(NULL,'Post',$Par->IDRuas));
		
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Lebar';
		$Row[$index]->Name = 'Lebar';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Value = $Result->lebar;
		$Row[$index]->Attribute = 'M';
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new FloatValidator());
		
		$index++;
		$Row[$index] = $Gui->MakeComboBox();
		$Row[$index]->Name = 'NamaLajur';
		$Row[$index]->TextToDisplay = 'Nama Lajur';
		$Row[$index]->ItemSelected = $Result->id__mst_lajur;
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
#		$Row[$index]->IsReadOnly = TRUE;
		$Row[$index]->AddValidator(new CekSurveyDeskripsiRuasJalanValidator($Par->IdLajur,$Par->IDRuas,$Par->WaktuSurvey,$Par->Post, $Par->Offset));
		
	
#		$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
	/*
		$index++;
		$Row[$index] = $Gui->MakeComboBox();
		$Row[$index]->Name = 'JenisBahu';
		$Row[$index]->TextToDisplay = 'Jenis Bahu';
		$Row[$index]->ItemSelected = $Result->id__mst_jenis_bahu;
		$Row[$index]->FromQuery($Conn,"
			SELECT 
				id AS id, 
				nama AS name
			FROM mst_jenis_bahu
			WHERE id__mst_bahu_group = 
			ORDER BY nama
		");	
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
		
		*/$index++;
		$Row[$index] = $Gui->MakeBottomButton();
		$Row[$index]->OnClickMenu = clone($Par->Child());

		$Form->Action = new UpdateSurveyDeskripsiRuasJalanHandlerMenu();
		$Form->Action->IDRuas = $Par->IDRuas; 
		$Form->Action->WaktuSurvey = $Par->WaktuSurvey; 
		$Form->Action->Post = $Par->Post; 
		$Form->Action->Offset = $Par->Offset; 
		$Form->Action->IdLajur = $Par->IdLajur; 
		$Form->Action->Next = clone($Par);
		
		for($a=0; $a<count($Row); $a++){
			$Form->AddRowElement($Row[$a]);
		}		
		$Form->Display($Par, $v);
	}
	public function Path(){return __FILE__;}
}
?>