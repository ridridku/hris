<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';
require_once FW_DIR . '/constant/ComboBox.cst.php';

class UpdateUserContent extends ContentInterface
{

  const RowCek = 0;
 
  public function UpdateUserContent(){
	ContentInterface::ContentInterface();
  }
  
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	$sql = "
		SELECT * 
		FROM sys_operator 
		WHERE id = '".$p->Kode."' 
	";
	$rsl = $db->Execute($sql);
   	$Field = $db->FetchObject($rsl);

	$g = $p->MakeGuiFactory();
	
	$f = $g->MakeForm();
	$f->FormName = 'DataOperator';

    $RowJudul = $g->MakeSubTitle();
	$RowJudul->TextToDisplay = 'Update Operator';
	$f->AddRowElement($RowJudul);
	
	$RowKode = $g->MakeTextBox();
	$RowKode->TextToDisplay = 'NIP';
	$RowKode->Name = 'Kode';
	$RowKode->Value = $p->Kode ;
	$RowKode->Size = 16;
	$RowKode->Maxlength = 16;
    $RowKode->Mandatory = TRUE;
	$RowKode->AddValidator(new StringLengthValidator(64, 1));
	$f->AddRowElement($RowKode);
	 
   	  		
	$RowNama = $g->MakeTextBox();
	$RowNama->TextToDisplay = 'Nama';
	$RowNama->Name = 'name';
	$RowNama->Value = $Field->name ;
	$RowNama->Size = 64;
	$RowNama->Maxlength = 64;
    $RowNama->Mandatory = TRUE;
	$RowNama->AddValidator(new StringLengthValidator(64, 1));
	$f->AddRowElement($RowNama);
	 	
	$Rowaddress = $g->MakeTextArea();
	$Rowaddress->TextToDisplay = 'Alamat';
	$Rowaddress->Name = 'alamat';
	$Rowaddress->Value = $Field->address;
	$Rowaddress->Column = 64;
	$Rowaddress->Rows = 2;
	$Rowaddress->Mandatory = false;
	$Rowaddress->AddValidator(new StringLengthValidator(128, 1));
	$f->AddRowElement($Rowaddress);
	
	
		
	$Rowtelp = $g->MakeTextBox();
	$Rowtelp->TextToDisplay = 'Telepon';
	$Rowtelp->Name = 'telp';
	$Rowtelp->Value = $Field->telp;
	$Rowtelp->Mandatory = false;
	$Rowtelp->AddValidator(new HomePhoneNumberValidator());
	$f->AddRowElement($Rowtelp);
	
	
	
	$Rowemail = $g->MakeTextBox();
	$Rowemail->TextToDisplay = 'Email';
	$Rowemail->Name = 'address';
	$Rowemail->Value = $Field->email;
	$Rowemail->Mandatory = false;
	$Rowemail->AddValidator(new EmailAddressValidator());
	$f->AddRowElement($Rowemail);
	
	$Rowsms = $g->MakeTextBox();
	$Rowsms->TextToDisplay = 'SMS';
	$Rowsms->Name = 'sms';
	$Rowsms->Value = $Field->sms;
	$Rowsms->Mandatory = false;
	$Rowsms->AddValidator(new StringLengthValidator(128, 1));
	$f->AddRowElement($Rowsms);
	
	$r = $g->MakeComboBox();
	$r->TextToDisplay = 'Bidang';
	$r->Name = 'id_mst_balaibesar';
	$r->ItemSelected= $Field->id_mst_balaibesar;
	$r->FromQuery($db, "
		SELECT id AS id, nama AS name
		FROM mst_balaibesar
	");
	$r->Mandatory = false;
	$r->AddValidator(new ComboBoxValidator($r));
	$f->AddRowElement($r);
	
	
	
	$RowBreak2 = $g->MakeLabel();
	$f->AddRowElement($RowBreak2);

    $RowSave = $g->MakeBottomButton();
	$RowSave->OnClickMenu = clone($p->Child());
	$f->AddRowElement($RowSave);
	
	$f->Action = new UpdateUserHandlerMenu($p->Kode, $p->Status);
	$f->Action->Next = clone($p);
		
	$f->Display($p, $v);
	
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  
}
?>