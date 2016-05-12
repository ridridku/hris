<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertSurveyPosisiJembatanContent extends ContentInterface{
	public function InsertSurveyPosisiJembatanContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();
		$g = $p->MakeGuiFactory();
		$f = $g->MakeForm();
		$f->FormName = 'Data Location Survey Posisi Jembatan';

		
		$r = $g->MakeSubTitle();
		$r->TextToDisplay = 'Tambah Data Survey Ruas Jalan';
		$f->AddRowElement($r);	
	
		$rsl = $db->Execute("
			SELECT * 
			FROM mst_ruas_jalan
			WHERE id = '" . $p->IdLocRoad . "'
		");
		$R = $db->FetchObject($rsl);	
		
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = NULL;
		$r->Name = 'Jarak';
		$f->AddRowElement($r);
		
			
	
//		$SearchMasterRuasJalan = new SearchMasterRuasJalanMenu();
		$SearchMasterRuasJalan = new LibSvyRoadMenu();
		$SearchMasterRuasJalan->AddTail($this->Parent());
		$r = $g->MakeRefLabel();
		$r->Name = 'NamaRuasjalan';
		$r->TextToDisplay = 'Nama Ruas jalan';
		$r->ButtonValue = 'Cari';
		$r->Value = (!is_null($R->nama_ruas) ? $R->nama_ruas : ' - ');
		$r->Mandatory = true;
		$r->AddValidator(new SearchIdPencarianValidator());
		$r->Link = $SearchMasterRuasJalan->Ref();
		$f->AddRowElement($r);
		
		

		if(!is_null($p->IdLocRoad)){
				$r = $g->MakeComboBox();
			$r->Name = 'NamaJembatan';
			$r->TextToDisplay = 'Nama Jembatan';
			$r->FromQuery($db,"
				SELECT 
					id AS id, 
					nama AS name
				FROM mst_bridge
				WHERE
					`mst_bridge`.`id__mst_ruas_jalan`  =".$p->IdLocRoad ."
				ORDER BY nama
			");	
			$r->Mandatory = TRUE;
			$r->AddValidator(new ComboBoxValidator($r));
			
			 $f->AddRowElement($r);
		}
		
		
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Tanggal Survey';
		$r->Value = $p->TimeStamp;
		 $f->AddRowElement($r);

		$r = $g->MakeTextBox();
		$r->TextToDisplay = 'Kilometer';
		$r->Name = 'Post';
		$r->Size = 10;
		$r->Maxlength = 10;
		$r->Mandatory = TRUE;
		$r->AddValidator(new IntegerValidator(1, 20000));
		$f->AddRowElement($r);
	
		$r = $g->MakeTextBox();
		$r->TextToDisplay = 'Point';
		$r->Name = 'Offset';
		$r->Size = 10;
		$r->Maxlength = 10;
		$r->Mandatory = TRUE;
		$r->AddValidator(new IntegerValidator(1, 20000));
		$r->AddValidator(new CekSurveyPosisiJembatanValidator(NULL,$p->IdLocRoad, NULL, NULL, NULL, NULL));
		$f->AddRowElement($r);
		
		$r = $g->MakeTextArea();
		$r->Name = 'decription';
		$r->TextToDisplay = 'Keterangan';
		$r->Column = 64;
		$r->Rows = 2;
		$r->Mandatory = FALSE;	
		$r->AddValidator(new DefaultValidator());		
		$f->AddRowElement($r);
		
		
		$r = $g->MakeTextBox();
		$r->TextToDisplay = 'SPAN';
		$r->Name = 'span';
		$r->Attribute = 'm';
		$r->Size = 10;
		$r->Maxlength = 11;
		$r->Mandatory = false;
		$r->AddValidator(new FloatValidator());
		$f->AddRowElement($r);
		
		$r = $g->MakeTextBox();
		$r->TextToDisplay = 'WIDTH';
		$r->Name = 'width';
		$r->Attribute = 'm';
		$r->Size = 10;
		$r->Maxlength = 11;
		$r->Mandatory = false;
		$r->AddValidator(new FloatValidator());
		$f->AddRowElement($r);
		
		$r = $g->MakeTextBox();
		$r->TextToDisplay = 'FREEBOARD';
		$r->Name = 'free_board';
		$r->Attribute = 'm';
		$r->Size = 10;
		$r->Maxlength = 11;
		$r->Mandatory = false;
		$r->AddValidator(new FloatValidator());
		$f->AddRowElement($r);
		
		$r = $g->MakeComboBox();
		$r->Name = 'deck';
		$r->TextToDisplay = 'DECK';
		$r->ItemSelected = '-1';
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
		$r->ItemSelected = '-1';
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
		$r->ItemSelected = '-1';
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
		$r->ItemSelected = '-1';
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
		$r->ItemSelected = '-1';
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
		$r->ItemSelected = '-1';
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
		
		
		
		
				
		$r = $g->MakeBottomButton();
		$r->OnClickMenu = clone($p->Child());
		$f->AddRowElement($r);
		
		$f->Action = new InsertSurveyPosisiJembatanHandlerMenu();
		$f->Action->SearchIDRuas = $p->IdLocRoad;
		$f->Action->TimeStamp = $p->TimeStamp;
		$f->Action->Next = new UpdateSurveyPosisiJembatanMenu();
		$f->Action->Next->AddTail($p->Child());
#		$f->Action->Next = clone($p);
#		for($a=0; $a<count($Row); $a++){
#		  $f->AddRowElement($Row[$a]);
#		}		
		$f->Display($p, $v);
	}
	public function Path(){return __FILE__;}
}
?>