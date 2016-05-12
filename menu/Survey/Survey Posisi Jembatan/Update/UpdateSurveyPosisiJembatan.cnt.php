<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateSurveyPosisiJembatanContent extends ContentInterface{
	public function UpdateSurveyPosisiJembatanContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();
		$g = $p->MakeGuiFactory();
		$f = $g->MakeForm();
		
		$r = $g->MakeSubTitle();
		$r->TextToDisplay = 'Edit Survey Posisi Jembatan';
		$f->AddRowElement($r);	
		
		$TimeTemp = explode(' ',$p->WaktuSurvey);
		$Tanggal = $TimeTemp[0];
		$Waktu = $TimeTemp[1];
		
		$rsl = $db->Execute("
			SELECT * 
			FROM mst_ruas_jalan
			WHERE id = '" . $p->IDRuas . "'
		");
		$R = $db->FetchObject($rsl);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = NULL;
		$r->Name = 'Jarak';
		$f->AddRowElement($r);	
			
		$r = $g->MakeLabel();
		$r->Name = 'NamaRuasjalan';
		$r->TextToDisplay = 'Nama Ruas jalan';
		$r->FromQuery($db,"
			SELECT nama_ruas AS Value
			FROM mst_ruas_jalan
			WHERE id = '" . $p->IDRuas . "'
		");
		$f->AddRowElement($r);	

		$r = $g->MakeLabel();
		$r->Name = 'NamaJembatan';
		$r->TextToDisplay = 'Nama Jembatan';
		$r->FromQuery($db,"
			SELECT 
				id AS id, 
				nama AS Value
			FROM mst_bridge
			WHERE
				mst_bridge.id = '". $p->IDJembatan ."'
			ORDER BY nama
		");	
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Tanggal Survey';
		$r->Value = $p->WaktuSurvey;
		$f->AddRowElement($r);	

		$r = $g->MakeTextBox();
		$r->TextToDisplay = 'Kilometer';
		$r->Name = 'Post';
		$r->Value = $p->Post;
		$r->Size = 10;
		$r->Maxlength = 10;
		$r->Mandatory = TRUE;
		$r->AddValidator(new IntegerValidator(1, 20000));
		$f->AddRowElement($r);	
	
		$r = $g->MakeTextBox();
		$r->TextToDisplay = 'Point';
		$r->Name = 'Offset';
		$r->Value = $p->Offset;
		$r->Size = 10;
		$r->Maxlength = 10;
		$r->Mandatory = TRUE;
		$r->AddValidator(new IntegerValidator(1, 20000));
		if($p->Kode == NULL){
			$r->AddValidator(new CekSurveyPosisiJembatanValidator(
				$p->Offset, $p->IDRuas, $p->IDJembatan, $p->Post, $p->IDRuas, $p->WaktuSurvey)
			);
		}else{
			$r->AddValidator(new CekSurveyPosisiJembatanValidator(
				$p->Offset, $p->Kode, $p->IDJembatan, $p->Post, $p->IDRuas, $p->WaktuSurvey)
			);
		}
		
		$f->AddRowElement($r);	
		#--------------------------------------------------
		
		$keyField[0] = 'id_mst_bridge';
		$keyField[1] = 'id__mst_ruas_jalan';
		$keyField[2] = 'timestamp';
		$keyField[3] = 'post';
		$keyField[4] = 'offset'	;
		$keyVal[0] =  $p->IDJembatan;
		$keyVal[1] =  $p->IDRuas;
		$keyVal[2] =  $p->WaktuSurvey;
		$keyVal[3] =  $p->Post;
		$keyVal[4] =  $p->Offset;			
		$dataBridgePosition = CommonQuery::ReadTable($db,'svy_posisi_jembatan',$keyField, $keyVal);


		$r = $g->MakeTextArea();
		$r->Name = 'keterangan';
		$r->TextToDisplay = 'Keterangan';
		$r->Value = $dataBridgePosition['keterangan'];		
		$r->Column = 64;
		$r->Rows = 2;
		$r->Mandatory = FALSE;	
		$r->AddValidator(new DefaultValidator());	
		$f->AddRowElement($r);	
		
		$r = $g->MakeTextBox();
		$r->TextToDisplay = 'SPAN';
		$r->Name = 'span';
		$r->Attribute = 'm';
		$r->Value = $dataBridgePosition['span'];
		$r->Size = 10;
		$r->Maxlength = 11;
		$r->Mandatory = false;
		$r->AddValidator(new FloatValidator());	
		$f->AddRowElement($r);	
		
		$r = $g->MakeTextBox();
		$r->TextToDisplay = 'WIDTH';
		$r->Name = 'width';
		$r->Attribute = 'm';
		$r->Value = $dataBridgePosition['width'];
		$r->Size = 10;
		$r->Maxlength = 11;
		$r->Mandatory = false;
		$r->AddValidator(new FloatValidator());	
		$f->AddRowElement($r);	
		
		$r = $g->MakeTextBox();
		$r->TextToDisplay = 'FREEBOARD';
		$r->Name = 'free_board';
		$r->Attribute = 'm';
		$r->Value = $dataBridgePosition['free_board'];
		$r->Size = 10;
		$r->Maxlength = 11;
		$r->Mandatory = false;
		$r->AddValidator(new FloatValidator());	
		$f->AddRowElement($r);	
		
		$r = $g->MakeComboBox();
		$r->Name = 'deck';
		$r->TextToDisplay = 'DECK';
		$r->ItemSelected = (is_null($dataBridgePosition['deck']) ?'-1' :$dataBridgePosition['deck']);
		$r->FromQuery($db,"
			SELECT 
				mst_required.id AS id, 
				mst_required.nama AS name 
			FROM 
				 mst_required 
			ORDER BY id
		");
		$r->Mandatory = false;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);
		
		$r = $g->MakeComboBox();
		$r->TextToDisplay = 'BEAMS';
		$r->Name = 'beams';		
		$r->ItemSelected = (is_null($dataBridgePosition['beams']) ? '-1': $dataBridgePosition['beams']);
		$r->FromQuery($db,"
			SELECT 
				mst_required.id AS id, 
				mst_required.nama AS name 
			FROM 
				 mst_required 
			ORDER BY id
		");
		$r->Mandatory = false;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);
		
		$r = $g->MakeComboBox();
		$r->TextToDisplay = 'SIDERAILS';
		$r->Name = 'side_rails';		
		$r->ItemSelected = (is_null($dataBridgePosition['side_rails']) ? '-1' : $dataBridgePosition['side_rails']);
		$r->FromQuery($db,"
			SELECT 
				mst_required.id AS id, 
				mst_required.nama AS name 
			FROM 
				 mst_required 
			ORDER BY id
		");
		$r->Mandatory = false;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);
		
		$r = $g->MakeComboBox();
		$r->TextToDisplay = 'ABUTMENT';
		$r->Name = 'abutment';		
		$r->ItemSelected = (is_null($dataBridgePosition['abutment'])?'-1':$dataBridgePosition['abutment']);
		$r->FromQuery($db,"
			SELECT 
				mst_required.id AS id, 
				mst_required.nama AS name 
			FROM 
				 mst_required 
			ORDER BY id
		");
		$r->Mandatory = false;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);
		
		
		$r = $g->MakeComboBox();
		$r->TextToDisplay = 'FOUNDATION';
		$r->Name = 'foundation';		
		$r->ItemSelected = (is_null($dataBridgePosition['foundation'])?'-1':$dataBridgePosition['foundation']);
		$r->FromQuery($db,"
			SELECT 
				mst_required.id AS id, 
				mst_required.nama AS name 
			FROM 
				 mst_required 
			ORDER BY id
		");
		$r->Mandatory = false;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);
		
		
		$r = $g->MakeComboBox();
		$r->TextToDisplay = 'PAVEMENT';
		$r->Name = 'pavement';		
		$r->ItemSelected = (is_null($dataBridgePosition['pavement'])?'-1':$dataBridgePosition['pavement']);
		$r->FromQuery($db,"
			SELECT 
				mst_required.id AS id, 
				mst_required.nama AS name 
			FROM 
				 mst_required 
			ORDER BY id
		");
		$r->Mandatory = false;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);
		
		
		
		#--------------------------------------------------

		


		$r = $g->MakeSubTitle();
		$r->TextToDisplay = 'Referensi Image';
		$f->AddRowElement($r);	
	
		$KeyColumn[0] = 'id_mst_bridge';
		$KeyColumn[1] = 'id__mst_ruas_jalan';
		$KeyColumn[2] = 'timestamp';
		$KeyColumn[3] = 'post';
		$KeyColumn[4] = 'offset';
		$KeyColumn[5] = 'img_id';
		$KeyValue[0] = $p->IDJembatan;
		$KeyValue[1] = $p->IDRuas;
		$KeyValue[2] = $p->WaktuSurvey;
		$KeyValue[3] = $p->Post;
		$KeyValue[4] = $p->Offset;
		$KeyValue[5] = 1;
		$Master = CommonQuery::ReadTable($db, 'svy_posisi_jembatan_image', $KeyColumn, $KeyValue);
		if($Master){
			$r = $g->MakeLabel();
			$r->TextToDisplay = 'File Name 1';
			$r->Value = $Master['file_name'];
			$f->AddRowElement($r);	
		}
		
		$r = $g->MakeFileInput();
		$r->Name = 'file_upload_1';
		$r->TextToDisplay = 'Image File 1';
		$r->Size = '900000000';
		$r->Mandatory = false;
		$r->AddValidator(new FileValidator($r->Size));
		$f->AddRowElement($r);	
	
		$KeyColumn[0] = 'id_mst_bridge';
		$KeyColumn[1] = 'id__mst_ruas_jalan';
		$KeyColumn[2] = 'timestamp';
		$KeyColumn[3] = 'post';
		$KeyColumn[4] = 'offset';
		$KeyColumn[5] = 'img_id';
		$KeyValue[0] = $p->IDJembatan;
		$KeyValue[1] = $p->IDRuas;
		$KeyValue[2] = $p->WaktuSurvey;
		$KeyValue[3] = $p->Post;
		$KeyValue[4] = $p->Offset;
		$KeyValue[5] = 2;
		$Master = CommonQuery::ReadTable($db, 'svy_posisi_jembatan_image', $KeyColumn, $KeyValue);
		if($Master){
			$r = $g->MakeLabel();
			$r->TextToDisplay = 'File Name 2';
			$r->Value = $Master['file_name'];
			$f->AddRowElement($r);	
		}
		
		$r = $g->MakeFileInput();
		$r->Name = 'file_upload_2';
		$r->TextToDisplay = 'Image File 2';
		$r->Size = '900000000';
		$r->Mandatory = false;
		$r->AddValidator(new FileValidator($r->Size));
		$f->AddRowElement($r);	
	
		$KeyColumn[0] = 'id_mst_bridge';
		$KeyColumn[1] = 'id__mst_ruas_jalan';
		$KeyColumn[2] = 'timestamp';
		$KeyColumn[3] = 'post';
		$KeyColumn[4] = 'offset';
		$KeyColumn[5] = 'img_id';
		$KeyValue[0] = $p->IDJembatan;
		$KeyValue[1] = $p->IDRuas;
		$KeyValue[2] = $p->WaktuSurvey;
		$KeyValue[3] = $p->Post;
		$KeyValue[4] = $p->Offset;
		$KeyValue[5] = 3;
		$Master = CommonQuery::ReadTable($db, 'svy_posisi_jembatan_image', $KeyColumn, $KeyValue);
		if($Master){
			$r = $g->MakeLabel();
			$r->TextToDisplay = 'File Name 3';
			$r->Value = $Master['file_name'];
			$f->AddRowElement($r);	
		}
		
		$r = $g->MakeFileInput();
		$r->Name = 'file_upload_3';
		$r->TextToDisplay = 'Image File 3';
		$r->Size = '900000000';
		$r->Mandatory = false;
		$r->AddValidator(new FileValidator($r->Size));
		$f->AddRowElement($r);	
						
		$KeyColumn[0] = 'id_mst_bridge';
		$KeyColumn[1] = 'id__mst_ruas_jalan';
		$KeyColumn[2] = 'timestamp';
		$KeyColumn[3] = 'post';
		$KeyColumn[4] = 'offset';
		$KeyColumn[5] = 'img_id';
		$KeyValue[0] = $p->IDJembatan;
		$KeyValue[1] = $p->IDRuas;
		$KeyValue[2] = $p->WaktuSurvey;
		$KeyValue[3] = $p->Post;
		$KeyValue[4] = $p->Offset;
		$KeyValue[5] = 4;
		$Master = CommonQuery::ReadTable($db, 'svy_posisi_jembatan_image', $KeyColumn, $KeyValue);
		if($Master){
			$r = $g->MakeLabel();
			$r->TextToDisplay = 'File Name 4';
			$r->Value = $Master['file_name'];
			$f->AddRowElement($r);	
		}
		
		$r = $g->MakeFileInput();
		$r->Name = 'file_upload_4';
		$r->TextToDisplay = 'Image File 4';
		$r->Size = '900000000';
		$r->Mandatory = false;
		$r->AddValidator(new FileValidator($r->Size));
		$f->AddRowElement($r);	
		
		$KeyColumn[0] = 'id_mst_bridge';
		$KeyColumn[1] = 'id__mst_ruas_jalan';
		$KeyColumn[2] = 'timestamp';
		$KeyColumn[3] = 'post';
		$KeyColumn[4] = 'offset';
		$KeyColumn[5] = 'img_id';
		$KeyValue[0] = $p->IDJembatan;
		$KeyValue[1] = $p->IDRuas;
		$KeyValue[2] = $p->WaktuSurvey;
		$KeyValue[3] = $p->Post;
		$KeyValue[4] = $p->Offset;
		$KeyValue[5] = 5;
		$Master = CommonQuery::ReadTable($db, 'svy_posisi_jembatan_image', $KeyColumn, $KeyValue);
		if($Master){
			$r = $g->MakeLabel();
			$r->TextToDisplay = 'File Name 5';
			$r->Value = $Master['file_name'];
			$f->AddRowElement($r);	
		}
		
		$r = $g->MakeFileInput();
		$r->Name = 'file_upload_5';
		$r->TextToDisplay = 'Image File 5';
		$r->Size = '900000000';
		$r->Mandatory = false;
		$r->AddValidator(new FileValidator($r->Size));		
		$f->AddRowElement($r);	
		
				
		$r = $g->MakeBottomButton();
		$r->OnClickMenu = clone($p->Child());
		$f->AddRowElement($r);	
		$f->Action = new UpdateSurveyPosisiJembatanHandlerMenu();
		$f->Action->IDJembatan = $p->IDJembatan;
		$f->Action->IDRuas = $p->IDRuas;
		$f->Action->WaktuSurvey = $p->WaktuSurvey;
		$f->Action->Post = $p->Post;
		$f->Action->Offset = $p->Offset;
		$f->Action->UnixTimeSurvey = $p->UnixTimeSurvey;		
		$f->Action->Next = clone($p->Child());
		
#		for($a=0; $a<count($r); $a++){
#			$f->AddRowElement($r[$a]);
#		}		
		$f->Display($p, $v);
	}
	public function Path(){return __FILE__;}
}
?>