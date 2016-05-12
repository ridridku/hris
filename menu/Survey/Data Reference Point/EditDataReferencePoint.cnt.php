<?
require_once FW_DIR .  '/lib/CommonQuery.php';
/**
 * @package Content
 */
class EditDataReferencePointContent extends ContentInterface
{
  public function EditDataReferencePointContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
  	$g = $p->MakeGuiFactory();
	$f = $g->MakeForm();
	
	//read tabel svy_drp
	$Column[0] = 'id__mst_ruas_jalan';
	$Column[1] = 'time_stamp';
	$Column[2] = 'post';
	$Column[3] = 'offset';
	$Key[0] = $p->IdRoad;
	$Key[1] = $p->TimeSurvey;
	$Key[2] = $p->Post;
	$Key[3] = $p->Offset;
	$OldSvyDrp = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan', $Column, $Key);
	
	$r = $g->MakeSubTitle();
	$r->TextToDisplay = 'Edit Data Reference Point';
	$f->AddRowElement($r);
	
	$KeyColumn[0] = 'id';
	$KeyName[0] = $p->IdRoad;
	$OldDataRoad = CommonQuery::ReadTable($db, 'mst_ruas_jalan', $KeyColumn, $KeyName);
	
	$r = $g->MakeLabel();
	$r->TextToDisplay = 'Ruas Jalan';
	$r->Value = $OldDataRoad['nama_ruas'];
	$f->AddRowElement($r);
	
	$r = $g->MakeLabel();
	$r->TextToDisplay = 'Waktu Survey';
	$r->Value = $p->TimeSurvey;
	$f->AddRowElement($r);
	
	$r = $g->MakeLabel();
	$r->TextToDisplay = 'Kilometer';
	$r->Value = $p->Post;
	$f->AddRowElement($r);
	
	$r = $g->MakeLabel();
	$r->TextToDisplay = 'Point';
	$r->Value = $p->Offset;
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->Name = 'gps_lat';
	$r->TextToDisplay = 'Latitude';
	$r->Size = 27;
	$r->MaxLength = 17;
	$r->Value = $OldSvyDrp['gps_lat'];
	$r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->Name = 'gps_lon';
	$r->TextToDisplay = 'Longitude';
	$r->Size = 27;
	$r->MaxLength = 17;
	$r->Value = $OldSvyDrp['gps_lon'];
	$r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->Name = 'gps_alt';
	$r->TextToDisplay = 'Altitude';
	$r->Size = 27;
	$r->MaxLength = 17;
	$r->Value = $OldSvyDrp['gps_alt'];
	$r->Attribute = 'm';
	$r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->Name = 'gps_elev';
	$r->TextToDisplay = 'Elev';
	$r->Size = 27;
	$r->MaxLength = 17;
	$r->Value = $OldSvyDrp['gps_elev'];
	$r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());
	$f->AddRowElement($r);
	
	$r = $g->MakeSubTitle();
	$r->TextToDisplay = 'Referensi Image';
	$f->AddRowElement($r);

	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'time_stamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyColumn[4] = 'img_id';
	$KeyValue[0] = $p->IdRoad;
	$KeyValue[1] = $p->TimeSurvey;
	$KeyValue[2] = $p->Post;
	$KeyValue[3] = $p->Offset;
	$KeyValue[4] = 1;
	$Master = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_image', $KeyColumn, $KeyValue);
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
	
	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'time_stamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyColumn[4] = 'img_id';
	$KeyValue[0] = $p->IdRoad;
	$KeyValue[1] = $p->TimeSurvey;
	$KeyValue[2] = $p->Post;
	$KeyValue[3] = $p->Offset;
	$KeyValue[4] = 2;
	$Master = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_image', $KeyColumn, $KeyValue);
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
	
	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'time_stamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyColumn[4] = 'img_id';
	$KeyValue[0] = $p->IdRoad;
	$KeyValue[1] = $p->TimeSurvey;
	$KeyValue[2] = $p->Post;
	$KeyValue[3] = $p->Offset;
	$KeyValue[4] = 3;
	$Master = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_image', $KeyColumn, $KeyValue);
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
	
	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'time_stamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyColumn[4] = 'img_id';
	$KeyValue[0] = $p->IdRoad;
	$KeyValue[1] = $p->TimeSurvey;
	$KeyValue[2] = $p->Post;
	$KeyValue[3] = $p->Offset;
	$KeyValue[4] = 4;
	$Master = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_image', $KeyColumn, $KeyValue);
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
	
	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'time_stamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyColumn[4] = 'img_id';
	$KeyValue[0] = $p->IdRoad;
	$KeyValue[1] = $p->TimeSurvey;
	$KeyValue[2] = $p->Post;
	$KeyValue[3] = $p->Offset;
	$KeyValue[4] = 5;
	$Master = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_image', $KeyColumn, $KeyValue);
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

	$r = $g->MakeSubTitle();
	$r->TextToDisplay = 'Referensi Video';
	$f->AddRowElement($r);

	for($i=0; $i<5; $i++){
		$Master = CommonQuery::ReadTable(
			$db, 
			'svy_drp_ruas_jalan_movie', 
			array(
				0 => 'id__mst_ruas_jalan',
				1 => 'time_stamp',
				2 => 'post',
				3 => 'offset',
				4 => 'mov_id'
			), 
			array(
				0 => $p->IdRoad,
				1 => $p->TimeSurvey,
				2 => $p->Post,
				3 => $p->Offset,
				4 => $i
			)		
		);
		if($Master){
			$r = $g->MakeLabel();
			$r->TextToDisplay = 'File Name ' . ($i + 1);
			$r->Value = $Master['file_name'];
			$f->AddRowElement($r);
		}
		$r = $g->MakeFileInput();
		$r->Name = 'movie_upload_' . $i;
		$r->TextToDisplay = 'Video File ' . ($i + 1);
		$r->Size = '900000000';
		$r->Mandatory = false;
		$r->AddValidator(new FileValidator($r->Size));
		$f->AddRowElement($r);
	}
	
	$r = $g->MakeBottomButton();
	$r->OnClickMenu = clone($p->Child());
	$f->AddRowElement($r);
		 
	$f->Action = new EditDataReferencePointHandlerMenu();
	$f->Action->IdRoad = $p->IdRoad;
	$f->Action->TimeSurvey = $p->TimeSurvey;
	$f->Action->Post = $p->Post;
	$f->Action->Offset = $p->Offset;
	$f->Action->UnixTimeSurvey = $p->UnixTimeSurvey;
	$f->Action->Next = clone($p);
	$f->Action->Next->IdRoad = $p->IdRoad;
	$f->Action->Next->TimeSurvey = $p->TimeSurvey;
	$f->Action->Next->Post = $p->Post;
	$f->Action->Next->Offset = $p->Offset;
	$f->Action->Next->UnixTimeSurvey = $p->UnixTimeSurvey;
	$f->Display($p, $v);
  }
  public function Path(){return __FILE__;}
}
?>