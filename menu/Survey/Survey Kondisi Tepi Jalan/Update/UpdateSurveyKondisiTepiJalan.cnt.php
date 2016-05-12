<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateSurveyKondisiTepiJalanContent extends ContentInterface{
	public function UpdateSurveyKondisiTepiJalanContent(){
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
	$Row[$index]->TextToDisplay = 'Edit Survey Kondisi Jalan';	
	$QUERY = $Conn->Execute("
		SELECT *, DT_IndonesiaDateTime(timestamp) AS Waktu
		FROM `svy_kondisi_tepi_jalan`
		WHERE
			`id__mst_ruas_jalan` = '" . $Par->IDRuas ."'  AND
			`timestamp` = '". $Par->TimeStamp ."' AND
			`post` = '" . $Par->Post ."'  AND
			`offset` = '" . $Par->Offset ."'  AND
			`id__mst_lajur` = '" . $Par->IDLajur ."'
	");
	$rec = $Conn->Fetchobject($QUERY);
	
   	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = NULL;
	$Row[$index]->Name = 'Jarak';
    	
	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->Name = 'NamaRuasjalan';
	$Row[$index]->TextToDisplay = 'Nama Ruas jalan';
	$Row[$index]->FromQuery($Conn, "
		SELECT nama_ruas AS Value
		FROM mst_ruas_jalan
		WHERE id = '" . $rec->id__mst_ruas_jalan . "'
	");
	
	$index++;
	$Row[$index] = $Gui->MakeLabel();
	$Row[$index]->TextToDisplay = 'Waktu Survey';
	$Row[$index]->Value = $rec->Waktu;
	
   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Kilometer Awal';
	$Row[$index]->Name = 'Post';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
	$Row[$index]->Value = $rec->post;
    $Row[$index]->Mandatory = TRUE;
	$Row[$index]->AddValidator(new FloatValidator());

   	$index++;
	$Row[$index] = $Gui->MakeTextBox();
	$Row[$index]->TextToDisplay = 'Kilometer Akhir';
	$Row[$index]->Name = 'Offset';
	$Row[$index]->Size = 16;
	$Row[$index]->Maxlength = 16;
	$Row[$index]->Value = $rec->offset;
    $Row[$index]->Mandatory = TRUE;
#	$Row[$index]->AddValidator(new CekDataInputKmValidator(NULL,'Post',$Par->IDRuas));
	$Row[$index]->AddValidator(new FloatValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'NamaLajur';
	$Row[$index]->TextToDisplay = 'Nama lajur';
	$Row[$index]->ItemSelected = $rec->id__mst_lajur;
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
	
	$rsl = $Conn->Execute("
		SELECT
			id__mst_bahu_group AS IdGroupBahu
		FROM
			mst_lajur
		WHERE
			id = '".$Par->IDLajur."'
	");
	$Field = $Conn->FetchArray($rsl);
	$Par->IdGroup = $Field['IdGroupBahu'];

	$index++;
	$Row[$index] = $Gui->MakeComboBox();
	$Row[$index]->Name = 'JenisBahu';
	$Row[$index]->TextToDisplay = 'Jenis Bahu';
	$Row[$index]->ItemSelected = $rec->id__mst_jenis_bahu;	
	$Row[$index]->FromQuery($Conn,"
		SELECT
			mst_jenis_bahu.id as id,
			mst_jenis_bahu.nama as name
		
		FROM
			mst_jenis_bahu
		WHERE
		   mst_jenis_bahu.id__mst_bahu_group =  '". (is_null($Par->IdGroup)?4:$Par->IdGroup) ."'
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
	$Row[$index]->ItemSelected = $rec->id__mst_kondisi_jalan;
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
	$Row[$index]->Value = $rec->lebar;
    $Row[$index]->Mandatory = FALSE;
	$Row[$index]->AddValidator(new FloatValidator());
	
	$index++;
	$Row[$index] = $Gui->MakeSubTitle();
	$Row[$index]->TextToDisplay = 'Referensi Image';

	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'timestamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyColumn[4] = 'id__mst_lajur';
	$KeyColumn[5] = 'img_id';
	$KeyValue[0] = $Par->IDRuas;
	$KeyValue[1] = $Par->TimeStamp;
	$KeyValue[2] = $Par->Post;
	$KeyValue[3] = $Par->Offset;
	$KeyValue[4] = $Par->IDLajur;
	$KeyValue[5] = 1;
	$Master = CommonQuery::ReadTable($Conn, 'svy_kondisi_tepi_jalan_image', $KeyColumn, $KeyValue);
	if($Master){
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'File Name 1';
		$Row[$index]->Value = $Master['file_name'];
	}
	
	$index++;
	$Row[$index] = $Gui->MakeFileInput();
	$Row[$index]->Name = 'file_upload_1';
	$Row[$index]->TextToDisplay = 'Image File 1';
	$Row[$index]->Size = '900000000';
	$Row[$index]->Mandatory = false;
	$Row[$index]->AddValidator(new FileValidator($Row[$index]->Size));
	
	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'timestamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyColumn[4] = 'id__mst_lajur';
	$KeyColumn[5] = 'img_id';
	$KeyValue[0] = $Par->IDRuas;
	$KeyValue[1] = $Par->TimeStamp;
	$KeyValue[2] = $Par->Post;
	$KeyValue[3] = $Par->Offset;
	$KeyValue[4] = $Par->IDLajur;
	$KeyValue[5] = 2;
	$Master = CommonQuery::ReadTable($Conn, 'svy_kondisi_tepi_jalan_image', $KeyColumn, $KeyValue);
	if($Master){
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'File Name 2';
		$Row[$index]->Value = $Master['file_name'];
	}
	$index++;
	$Row[$index] = $Gui->MakeFileInput();
	$Row[$index]->Name = 'file_upload_2';
	$Row[$index]->TextToDisplay = 'Image File 2';
	$Row[$index]->Size = '900000000';
	$Row[$index]->Mandatory = false;
	$Row[$index]->AddValidator(new FileValidator($Row[$index]->Size));
	
	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'timestamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyColumn[4] = 'id__mst_lajur';
	$KeyColumn[5] = 'img_id';
	$KeyValue[0] = $Par->IDRuas;
	$KeyValue[1] = $Par->TimeStamp;
	$KeyValue[2] = $Par->Post;
	$KeyValue[3] = $Par->Offset;
	$KeyValue[4] = $Par->IDLajur;
	$KeyValue[5] = 3;
	$Master = CommonQuery::ReadTable($Conn, 'svy_kondisi_tepi_jalan_image', $KeyColumn, $KeyValue);
	if($Master){
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'File Name 3';
		$Row[$index]->Value = $Master['file_name'];
	}
	$index++;
	$Row[$index] = $Gui->MakeFileInput();
	$Row[$index]->Name = 'file_upload_3';
	$Row[$index]->TextToDisplay = 'Image File 3';
	$Row[$index]->Size = '900000000';
	$Row[$index]->Mandatory = false;
	$Row[$index]->AddValidator(new FileValidator($Row[$index]->Size));
	
	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'timestamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyColumn[4] = 'id__mst_lajur';
	$KeyColumn[5] = 'img_id';
	$KeyValue[0] = $Par->IDRuas;
	$KeyValue[1] = $Par->TimeStamp;
	$KeyValue[2] = $Par->Post;
	$KeyValue[3] = $Par->Offset;
	$KeyValue[4] = $Par->IDLajur;
	$KeyValue[5] = 4;
	$Master = CommonQuery::ReadTable($Conn, 'svy_kondisi_tepi_jalan_image', $KeyColumn, $KeyValue);
	if($Master){
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'File Name 4';
		$Row[$index]->Value = $Master['file_name'];
	}
	$index++;
	$Row[$index] = $Gui->MakeFileInput();
	$Row[$index]->Name = 'file_upload_4';
	$Row[$index]->TextToDisplay = 'Image File 4';
	$Row[$index]->Size = '900000000';
	$Row[$index]->Mandatory = false;
	$Row[$index]->AddValidator(new FileValidator($Row[$index]->Size));
	
	$KeyColumn[0] = 'id__mst_ruas_jalan';
	$KeyColumn[1] = 'timestamp';
	$KeyColumn[2] = 'post';
	$KeyColumn[3] = 'offset';
	$KeyColumn[4] = 'id__mst_lajur';
	$KeyColumn[5] = 'img_id';
	$KeyValue[0] = $Par->IDRuas;
	$KeyValue[1] = $Par->TimeStamp;
	$KeyValue[2] = $Par->Post;
	$KeyValue[3] = $Par->Offset;
	$KeyValue[4] = $Par->IDLajur;
	$KeyValue[5] = 5;
	$Master = CommonQuery::ReadTable($Conn, 'svy_kondisi_tepi_jalan_image', $KeyColumn, $KeyValue);
	if($Master){
		$index++;
		$Row[$index] = $Gui->MakeLabel();
		$Row[$index]->TextToDisplay = 'File Name 5';
		$Row[$index]->Value = $Master['file_name'];
	}
	$index++;
	$Row[$index] = $Gui->MakeFileInput();
	$Row[$index]->Name = 'file_upload_5';
	$Row[$index]->TextToDisplay = 'Image File 5';
	$Row[$index]->Size = '900000000';
	$Row[$index]->Mandatory = false;
	$Row[$index]->AddValidator(new FileValidator($Row[$index]->Size));
		
	$index++;
	$Row[$index] = $Gui->MakeBottomButton();
	$Row[$index]->OnClickMenu = clone($Par->Child());
	
	$Form->Action = new UpdateSurveyKondisiTepiJalanHandlerMenu();
	$Form->Action->IDRuas = $Par->IDRuas;
	$Form->Action->TimeStamp = $Par->TimeStamp;
	$Form->Action->Post = $Par->Post;
	$Form->Action->Offset = $Par->Offset;
	$Form->Action->IDLajur = $Par->IDLajur;
	$Form->Action->UnixTimeSurvey = $Par->UnixTimeSurvey;
	$Form->Action->Next = new UpdateSurveyKondisiTepiJalanMenu();
	$Form->Action->Next->UnixTimeSurvey = $Par->UnixTimeSurvey;
	$Form->Action->Next->AddTail($Par->Child());

	for($a=0; $a<count($Row); $a++){
	  $Form->AddRowElement($Row[$a]);
	}		
	$Form->Display($Par, $v);
	
  }
	public function Path(){return __FILE__;}
}
?>