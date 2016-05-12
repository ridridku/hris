<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateSurveyKondisiJalanContent extends ContentInterface{
	public function UpdateSurveyKondisiJalanContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();
		$Gui = $p->MakeGuiFactory();
		
		$index = 0;
		$Row = array();
		$Gui = $p->MakeGuiFactory();
		$Form = $Gui->MakeForm();
		
		$Row[$index] = $Gui->MakeSubTitle();
		$Row[$index]->TextToDisplay = 'Edit Survey Kondisi Jalan';
		
		$sql = "
			SELECT *,
				DT_IndonesiaDateTime(svy_kondisi_ruas_jalan.timestamp) AS TimeSurvey
			FROM svy_kondisi_ruas_jalan
			WHERE
				id__mst_ruas_jalan = '". $p->IdRuasJalan ."' AND
				timestamp = '". $p->Time."' AND
				post = '". $p->Post ."' AND
				offset = '". $p->Offset ."'	 AND
				id__mst_lajur = '". $p->IdLajur ."' 					
		";
		$Query = $db->Execute($sql);
		$Result = $db->FetchObject($Query);
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = NULL;
		$Row[$index]->Name = 'Jarak';
			
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'Nama Ruas jalan';
		$Row[$index]->Name = 'Nama Ruas jalan';
		$Row[$index]->FromQuery($db,"
			SELECT 
				id AS id, 
				nama_ruas AS Value
			FROM mst_ruas_jalan
			WHERE mst_ruas_jalan.id = '". $p->IdRuasJalan ."'
		");
		
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'Waktu Survey';
		$Row[$index]->Name = 'WaktuSurvey';
		$Row[$index]->Value = $p->Time;
		
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Kilometer Awal';
		$Row[$index]->Name = 'Post';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Value = $p->Post;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new FloatValidator());
	
		$index++;
		$Row[$index] = $Gui->MakeTextBox();
		$Row[$index]->TextToDisplay = 'Kilometer Akhir';
		$Row[$index]->Name = 'Offset';
		$Row[$index]->Size = 10;
		$Row[$index]->Maxlength = 10;
		$Row[$index]->Value = $p->Offset;
		$Row[$index]->Mandatory = TRUE;
		$Row[$index]->AddValidator(new FloatValidator());
		$Row[$index]->AddValidator(new CekDataInputKmValidator(NULL,'Post',$p->IdRuasJalan));
		$Row[$index]->AddValidator(new CekSurveyKondisiJalanValidator(
							$p->Offset,$p->IdRuasJalan,$p->Time,$p->Post,$p->IdLajur
					)
		);
		
		
		
		$index++;
		$Row[$index] = $Gui->MakeComboBox();
		$Row[$index]->Name = 'id__mst_lajur';
		$Row[$index]->TextToDisplay = 'Lajur';
		$Row[$index]->ItemSelected = $p->IdLajur;//$Result->id__mst_lajur;
		$Row[$index]->FromQuery($db,"
			SELECT 
				id AS id, 
				nama AS name
			FROM mst_lajur
			WHERE id IN('1','2')
			ORDER BY id
		");	
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->IsReadOnly = TRUE;

	
		$index++;
		$Row[$index] = $Gui->MakeComboBox();
		$Row[$index]->Name = 'KondisiJalan';
		$Row[$index]->TextToDisplay = 'Kondisi Jalan';
		$Row[$index]->ItemSelected = $Result->id__mst_kondisi_jalan;
		$Row[$index]->FromQuery($db,"
			SELECT 
				id AS id, 
				nama AS name
			FROM mst_kondisi_jalan
			ORDER BY id
		");	
		$Row[$index]->Mandatory = FALSE;
		$Row[$index]->AddValidator(new ComboBoxValidator($Row[$index]));
	
		$index++;
		$Row[$index] = $Gui->MakeBottomButton();
		$Row[$index]->OnClickMenu = clone($p->Child());

		$Form->Action = new UpdateSurveyKondisiJalanHandlerMenu();
		$Form->Action->IdRuasJalan = $p->IdRuasJalan; 
		$Form->Action->Time = $p->Time; 
		$Form->Action->Post = $p->Post; 
		$Form->Action->Offset = $p->Offset; 
		$Form->Action->IdLajur = $p->IdLajur; 		
		$Form->Action->Next = clone($p);
		
		for($a=0; $a<count($Row); $a++){
			$Form->AddRowElement($Row[$a]);
		}		
		$Form->Display($p, $v);
	}
	public function Path(){return __FILE__;}
}
?>