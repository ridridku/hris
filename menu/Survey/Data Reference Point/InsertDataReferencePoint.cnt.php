<?
require_once FW_DIR .  '/lib/CommonQuery.php';
/**
 * @package Content
 */
class InsertDataReferencePointContent extends ContentInterface
{
  public function InsertDataReferencePointContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
  	$g = $p->MakeGuiFactory();
	$f = $g->MakeForm();
	
	$r = $g->MakeSubTitle();
	$r->TextToDisplay = 'Tambah Data Reference Point';
	$f->AddRowElement($r);
	
	$KeyColumn[0] = 'id';
	$KeyName[0] = $p->IdLocRoad;
	$OldDataRoad = CommonQuery::ReadTable($db, 'mst_ruas_jalan', $KeyColumn, $KeyName);
	
	$r = $g->MakeRefLabel();
	$r->Name = 'id_loc_road';
	$r->TextToDisplay = 'Ruas Jalan';
	$r->ButtonValue = 'Cari';
	if(!(is_null($p->IdLocRoad))){
		$r->Value = $OldDataRoad['nama_ruas'];
	}
	$MenuLink = new LibSvyRoadMenu();
	$MenuLink->AddTail(clone($p));
	$r->Link = $MenuLink->Ref();
	$r->AddValidator(new SearchIdPencarianValidator());
	$f->AddRowElement($r);
	
	if(!(is_null($p->TimeStamp))){
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Waktu Survey';
		$r->Value = $p->TimeStamp;
		$f->AddRowElement($r);
	}
	
	$r = $g->MakeTextBox();
	$r->Name = 'post';
	$r->TextToDisplay = 'Kilometer';
	$r->Size = 20;
	$r->MaxLength = 11;
//	$r->AddValidator(new SearchIdPencarianValidator());
	$r->AddValidator(new IntegerValidator(0, 99999999999));
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->Name = 'offset';
	$r->TextToDisplay = 'Point';
	$r->Size = 20;
	$r->MaxLength = 11;
	$r->AddValidator(new IntegerValidator(0, 99999999999));
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->Name = 'gps_lat';
	$r->TextToDisplay = 'Latitude';
	$r->Size = 27;
	$r->MaxLength = 17;
	$r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->Name = 'gps_lon';
	$r->TextToDisplay = 'Longitude';
	$r->Size = 27;
	$r->MaxLength = 17;
	$r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->Name = 'gps_alt';
	$r->TextToDisplay = 'Altitude';
	$r->Size = 27;
	$r->MaxLength = 17;
	$r->Attribute = 'm';
	$r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->Name = 'gps_elev';
	$r->TextToDisplay = 'Elev';
	$r->Size = 27;
	$r->MaxLength = 17;
	$r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());
	$f->AddRowElement($r);
	
	$r = $g->MakeBottomButton();
	$r->OnClickMenu = clone($p->Child());
	$f->AddRowElement($r);
		 
	$f->Action = new InsertDataReferencePointHandlerMenu();
	$f->Action->IdLocRoad = $p->IdLocRoad;
	$f->Action->TimeStamp = $p->TimeStamp;
	$f->Action->Next = clone($p);
	
	$f->Display($p, $v);
  }
  public function Path(){return __FILE__;}
}
?>