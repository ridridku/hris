<?
/**
 * @package Content
 */
class UploadFileSurveyDeskripsiJalanContent extends ContentInterface
{
  public function UploadFileSurveyDeskripsiJalanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $Gui = $p->MakeGuiFactory();

	$f = $Gui->MakeForm();
	$f->FormName = 'DataDataAwal';
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Upload Excell Deskripsi Ruas Jalan';
	$f->AddRowElement($r);
	
	$r = $Gui->MakeFileInput();
	$r->Name = 'excel_file';
	$r->TextToDisplay = 'File Excell';
	$r->Size = '900000000';
	$r->Mandatory = false;
	$r->AddValidator(new FileValidator($r->Size));
	$f->AddRowElement($r);
	
	$r = $Gui->MakeSubTitle();
	//'<label style="font-size:12px;">' . $anObject->Name() . '</label>';
	$r->TextToDisplay = '<label style="font-size:9px; color:red" > Note <sup>*</sup> [ Hasil Upload harus diedit dulu sesuaikan  dengan Form yang ada] </label>';
	$f->AddRowElement($r);
	
		
    $r= $Gui->MakeLabel();
	$f->AddRowElement($r);

    $r= $Gui->MakeBottomButton();
	$f->AddRowElement($r);
	
	$f->Action = new UploadFileSurveyDeskripsiJalanHandlerMenu();
	$f->Action->Next = clone($p);			
	$f->Display($p, $v);
	
  }
  public function Path(){return __FILE__;}
}
?>