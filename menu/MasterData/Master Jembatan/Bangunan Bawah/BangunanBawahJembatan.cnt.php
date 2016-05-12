<?
/**
 * @package Content
 */
class BangunanBawahJembatanContent extends ContentInterface
{
  public function BangunanBawahJembatanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	$DataBangunan = CommonQuery::ReadTable($db, 'mst_bridge_bangunan_bawah', array('id_mst_bridge'), array($p->IdJembatan));	
	
  	$g = $p->MakeGuiFactory();
	$f = $g->MakeForm();

	$r = $g->MakeSubTitle();
	$r->TextToDisplay = 'Data Bangunan Bawah Jembatan';		
	$f->AddRowElement($r);
		
	
 	$r = $g->MakeLabel();
	$r->TextToDisplay = NULL;	
	$r->Value = $p->IdJembatan;	
	$f->AddRowElement($r);
 
 	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Peil Dasar Abutmen';
	$r->Name = 'peil_pondasi';
	$r->Value = $DataBangunan['peil_pondasi'];
	$r->Size = 16;
	$r->Maxlength = 15;
	$r->Attribute = 'Meter';	
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Jenis Pondasi';
	$r->Name = 'jenis_pondasi';
	$r->Value = $DataBangunan['jenis_pondasi'];	
	$r->Size = 36;
    $r->Mandatory = FALSE;
	$r->AddValidator(new StringLengthValidator(128,0));	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Diameter';
	$r->Name = 'diameter';
	$r->Value = $DataBangunan['diameter'];	
	$r->Size = 16;
	$r->Maxlength = 16;
	$r->Attribute = 'Meter';	
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Panjang';
	$r->Name = 'panjang';
	$r->Value = $DataBangunan['panjang'];
	$r->Size = 16;
	$r->Maxlength = 16;
	$r->Attribute = 'Meter';	
    $r->Mandatory = FALSE;	
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeTextBox();
	$r->TextToDisplay = 'Lebar';
	$r->Name = 'lebar';
	$r->Value = $DataBangunan['lebar'];	
	$r->Size = 16;
	$r->Maxlength = 16;
	$r->Attribute = 'm';
    $r->Mandatory = FALSE;
	$r->AddValidator(new FloatValidator());	
	$f->AddRowElement($r);
	
	$r = $g->MakeBottomButton();
	$f->AddRowElement($r);
	
	$f->Action = new BangunanBawahJembatanHandlerMenu();
	$f->Action->IdJembatan = $p->IdJembatan;
	$f->Action->Next = new BangunanBawahJembatanMenu();

#	for($a=0; $a<count($Row); $a++){
#	  $f->AddRowElement($Row[$a]);
#	}		
	$f->Display($p, $v);
	
  }
  public function Path(){return __FILE__;}
}
?>