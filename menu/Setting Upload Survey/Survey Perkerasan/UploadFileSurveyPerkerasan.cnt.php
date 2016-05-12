<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';
class UploadFileSurveyPerkerasanContent extends ContentInterface
{
  public function UploadFileSurveyPerkerasanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $Gui = $p->MakeGuiFactory();

	$f = $Gui->MakeForm();
	$f->FormName = 'DataDataAwal';
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Upload Excell Kondisi Perkerasan';
	$f->AddRowElement($r);
	
	$r = $Gui->MakeFileInput();
	$r->Name = 'excel_file';
	$r->TextToDisplay = 'File Excell';
	$r->Size = '900000000';
	$r->Mandatory = false;
	$r->AddValidator(new FileValidator($r->Size));
	$f->AddRowElement($r);
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = '<label style="font-size:9px; color:red" > Note <sup>*</sup> [ Hasil Upload harus diedit dulu sesuaikan  dengan Form yang ada] </label>';
	$f->AddRowElement($r);
	
		
    $r= $Gui->MakeLabel();
	$f->AddRowElement($r);

    $r= $Gui->MakeBottomButton();
	$f->AddRowElement($r);
	
	$f->Action = new UploadFileSurveyPerkerasanHandlerMenu();
	$f->Action->Next = clone($p);	
#	$f->Action->Next = new UploadFileSurveyKondisiJalanMenu();
	
//	$f->Action->Next->AddTail($p->Child());
		
	$f->Display($p, $v);
	
  }
 
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>