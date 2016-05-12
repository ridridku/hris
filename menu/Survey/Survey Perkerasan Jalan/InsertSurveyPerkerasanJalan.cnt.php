<?
/**
 * @package Content
 */
class InsertSurveyPerkerasanJalanContent extends ContentInterface
{
  public function InsertSurveyPerkerasanJalanContent(){
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
		$r[$i]->TextToDisplay = 'Tambah Survey Perkerasan Jalan';
		
		$i++;
		$r[$i] = $Gui->MakeLabel();
		$r[$i]->TextToDisplay = '';
		
		$rsl = $db->Execute("
				SELECT * 
				FROM mst_ruas_jalan
				WHERE id = '" . $p->SearchIDRuas . "'
		");
		$R = $db->FetchObject($rsl);	
	
		$i++;
		$SearchSurveyRuasJalan = new SearchSurveyRuasJalanMenu();
		$SearchSurveyRuasJalan->AddTail($this->Parent());
		$r[$i] = $Gui->MakeRefLabel();
		$r[$i]->Name = 'NamaRuasjalan';
		$r[$i]->TextToDisplay = 'Nama Ruas jalan';
		$r[$i]->ButtonValue = 'Cari';
		if($R->nama_ruas != NULL){
			$r[$i]->Value = $R->nama_ruas;
		}else{
			$r[$i]->Value = ' - ';
		}
		$r[$i]->Mandatory = true;
		$r[$i]->Link = $SearchSurveyRuasJalan->Ref();
		$r[$i]->AddValidator(new SearchIdPencarianValidator());
	
		if(!(is_null($p->SearchTimeStamp))){
			$i++;
			$r[$i] = $Gui->MakeLabel();
			$r[$i]->TextToDisplay = 'Waktu Survey';
			$r[$i]->FromQuery($db, "
				SELECT DT_IndonesiaDateTime('". $p->SearchTimeStamp ."') AS Value
			");
		}
		$i++;
		$r[$i] = $Gui->MakeTextBox();
		$r[$i]->TextToDisplay = 'Kilometer Awal';
		$r[$i]->Name = 'post';
		$r[$i]->Size = 10;
		$r[$i]->Maxlength = 10;
#		$r[$i]->Attribute  = 'Kilometer Awal';
		$r[$i]->Value = $p->Post;
		$r[$i]->Mandatory = TRUE;
		$r[$i]->AddValidator(new FloatValidator());
	
		$i++;
		$r[$i] = $Gui->MakeTextBox();
		$r[$i]->TextToDisplay = 'Kilometer Akhir';
		$r[$i]->Name = 'offset';
		$r[$i]->Size = 10;
		$r[$i]->Maxlength = 10;
#		$r[$i]->Attribute  = 'Kilometer Akhir';
		$r[$i]->Value = $p->Offset;
		$r[$i]->Mandatory = TRUE;
#		$r[$i]->AddValidator(new CekDataInputKmValidator(NULL,'Post', $p->SearchIDRuas));
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
		
	
	
		$i++;
		$r[$i] = $Gui->MakeBottomButton();
		$r[$i]->OnClickMenu = clone($p->Child());

		$Form->Action = new InsertSurveyPerkerasanJalanHandlerMenu();
		$Form->Action->SearchIDRuas = $p->SearchIDRuas;
		$Form->Action->SearchTimeStamp = $p->SearchTimeStamp; 
		$Form->Action->Next = new UpdateSurveyPerkerasanJalanMenu();
		$Form->Action->Next->AddTail($p->Child());
	
#		$Form->Action->Next = clone($p);
		
		for($a=0; $a<count($r); $a++){
			$Form->AddRowElement($r[$a]);
		}		
		$Form->Display($p, $v);
	}
  public function Path(){return __FILE__;}
}
?>