<?
/**
 * @package Content
 */
 
# require 'validator/CekSurveyPerkerasanJalan.vld.php';

class UpdateSurveyPerkerasanJalanContent extends ContentInterface
{
  public function UpdateSurveyPerkerasanJalanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();
		$Gui = $p->MakeGuiFactory();
		
		$i = 0;
		$r = array();
		$Gui = $p->MakeGuiFactory();
		$Form = $Gui->MakeForm();
		
		$r[$i] = $Gui->MakeSubTitle();
		$r[$i]->TextToDisplay = 'Edit Survey Perkerasan Jalan';
		
		$sql = "
			SELECT *,
				DT_IndonesiaDateTime(svy_perkerasan_jalan.timestamp) AS TimeSurvey
			FROM svy_perkerasan_jalan
			WHERE
				id__mst_ruas_jalan = '". $p->IdRuasJalan ."' AND
				timestamp = '". $p->TimeStamp."' AND
				post = '". $p->Post ."' AND
				offset = '". $p->Offset ."'	 AND
				id__mst_lajur = '". $p->IdLajur ."' AND 
				id__mst_perkerasan = '".$p->IdPerkerasan."'	 				
		";
		$Query = $db->Execute($sql);
		$Result = $db->FetchObject($Query);
		
		$i++;
		$r[$i] = $Gui->MakeLabel();
		$r[$i]->TextToDisplay = NULL;
		$r[$i]->Name = 'Jarak';
		
			
		$i++;
		$r[$i] = $Gui->MakeLabel();
		$r[$i]->TextToDisplay = 'Nama Ruas jalan';
		$r[$i]->FromQuery($db,"
			SELECT 
				id AS id, 
				nama_ruas AS Value
			FROM mst_ruas_jalan
			WHERE mst_ruas_jalan.id = '". $p->IdRuasJalan ."'
		");
		
		$i++;
		$r[$i] = $Gui->MakeLabel();
		$r[$i]->TextToDisplay = 'Waktu Survey';
		$r[$i]->Name = 'WaktuSurvey';
		$r[$i]->Value = $p->TimeStamp;
		
		$i++;
		$r[$i] = $Gui->MakeTextBox();
		$r[$i]->TextToDisplay = 'Kilometer Awal';
		$r[$i]->Name = 'post';
		$r[$i]->Size = 10;
		$r[$i]->Maxlength = 10;
		$r[$i]->Attribute  = 'Kilometer Awal';
		$r[$i]->Value = $p->Post;
		$r[$i]->Mandatory = true;
		$r[$i]->AddValidator(new FloatValidator());
	
		$i++;
		$r[$i] = $Gui->MakeTextBox();
		$r[$i]->TextToDisplay = 'Kilometer Akhir';
		$r[$i]->Name = 'offset';
		$r[$i]->Size = 10;
		$r[$i]->Maxlength = 10;
		$r[$i]->Attribute  = 'Kilometer Akhir';
		$r[$i]->Value = $p->Offset;
		$r[$i]->Mandatory = TRUE;
		$r[$i]->AddValidator(new CekDataInputKmValidator(NULL,'Post', $p->IdRuasJalan));
		$r[$i]->AddValidator(new FloatValidator());		
		
		$i++;
		$r[$i] = $Gui->MakeComboBox();
		$r[$i]->Name = 'id__mst_lajur';
		$r[$i]->TextToDisplay = 'Lajur';
		$r[$i]->ItemSelected = $p->IdLajur;
		$r[$i]->FromQuery($db,"
			SELECT 
				id AS id, 
				nama AS name
			FROM mst_lajur
			WHERE id IN('1','2')
			ORDER BY id
		");	
		$r[$i]->Mandatory = FALSE;
		$r[$i]->AddValidator(new ComboBoxValidator($r[$i]));
	
		$i++;
		$r[$i] = $Gui->MakeTextBox();
		$r[$i]->TextToDisplay = 'Lebar';
		$r[$i]->Name = 'lebar';
		$r[$i]->Size = 10;
		$r[$i]->Maxlength = 20;
		$r[$i]->Attribute  = 'Meter';
		$r[$i]->Value = $Result->lebar;
		$r[$i]->Mandatory = FALSE;
		$r[$i]->AddValidator(new FloatValidator());		
		
		$i++;
		$r[$i] = $Gui->MakeTextBox();
		$r[$i]->TextToDisplay = 'Tahun';
		$r[$i]->Name = 'tahun';
		$r[$i]->Size = 10;
		$r[$i]->MaxLength = 4;
		$r[$i]->Value = $Result->tahun;
		$r[$i]->Mandatory = FALSE;
		$r[$i]->AddValidator(new IntegerValidator(1,9999));		
		
		
	
		$i++;
		$r[$i] = $Gui->MakeComboBox();
		$r[$i]->Name = 'id__mst_perkerasan';
		$r[$i]->TextToDisplay = 'Jenis Perkerasan';
		$r[$i]->ItemSelected = $Result->id__mst_perkerasan;
		$r[$i]->FromQuery($db,"
			SELECT 
				id AS id, 
				nama AS name
			FROM mst_perkerasan
			ORDER BY id
		");	
		$r[$i]->Mandatory = FALSE;
		$r[$i]->AddValidator(new ComboBoxValidator($r[$i]));
		$r[$i]->AddValidator(new CekSurveyPerkerasanJalanValidator($p->IdPerkerasan, $p->IdRuasJalan,$p->TimeStamp, $p->Post, $p->Offset, $p->IdLajur));
		
	
	
		$i++;
		$r[$i] = $Gui->MakeBottomButton();
		$r[$i]->OnClickMenu = clone($p->Child());

		$Form->Action = new UpdateSurveyPerkerasanJalanHandlerMenu();
		$Form->Action->IdRuasJalan = $p->IdRuasJalan; 
		$Form->Action->TimeStamp = $p->TimeStamp; 
		$Form->Action->Post = $p->Post; 
		$Form->Action->Offset = $p->Offset; 
		$Form->Action->IdLajur = $p->IdLajur; 	
		$Form->Action->IdPerkerasan = $p->IdPerkerasan; 	
			
		$Form->Action->Next = clone($p);
		
		for($a=0; $a<count($r); $a++){
			$Form->AddRowElement($r[$a]);
		}		
		$Form->Display($p, $v);
	}
  public function Path(){return __FILE__;}
}
?>