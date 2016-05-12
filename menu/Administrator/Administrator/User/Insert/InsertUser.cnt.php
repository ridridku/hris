<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertUserContent extends ContentInterface
{
  const RowCek = 0;
  
  public function InsertUserContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $g = $p->MakeGuiFactory();

	$f = $g->MakeForm();
	$f->FormName = 'DataOperator';
	
	$RowSub = $g->MakeSubTitle();
	$RowSub->TextToDisplay = 'Tambah Data Operator';
	$f->AddRowElement($RowSub);

   	$RowKode = $g->MakeTextBox();
	$RowKode->TextToDisplay = 'NIP';
	$RowKode->Name = 'Kode';
	$RowKode->Size = 16;
	$RowKode->Maxlength = 16;
    $RowKode->Mandatory = TRUE;
	$RowKode->AddValidator(new StringLengthValidator(64, 1));
	$RowKode->AddValidator(new CommonMasterTableValidator('sys_operator', NULL));
	$f->AddRowElement($RowKode);
	 
   	  		
	$RowNama = $g->MakeTextBox();
	$RowNama->TextToDisplay = 'Nama';
	$RowNama->Name = 'name';
	$RowNama->Size = 64;
	$RowNama->Maxlength = 64;
    $RowNama->Mandatory = TRUE;
	$RowNama->AddValidator(new StringLengthValidator(64, 1));
	$f->AddRowElement($RowNama);
	 	
	$Rowaddress = $g->MakeTextArea();
	$Rowaddress->TextToDisplay = 'Alamat';
	$Rowaddress->Name = 'alamat';
	$Rowaddress->Column = 64;
	$Rowaddress->Rows = 2;
	$Rowaddress->Mandatory = false;
	$Rowaddress->AddValidator(new StringLengthValidator(128, 1));
	$f->AddRowElement($Rowaddress);
	
	
		
	$Rowtelp = $g->MakeTextBox();
	$Rowtelp->TextToDisplay = 'Telepon';
	$Rowtelp->Name = 'telp';
	$Rowtelp->Mandatory = false;
	$Rowtelp->AddValidator(new HomePhoneNumberValidator());
	$f->AddRowElement($Rowtelp);
	
	
	
	$Rowemail = $g->MakeTextBox();
	$Rowemail->TextToDisplay = 'Email';
	$Rowemail->Name = 'address';
	$Rowemail->Mandatory = false;
	$Rowemail->AddValidator(new EmailAddressValidator());
	$f->AddRowElement($Rowemail);
	
	$Rowsms = $g->MakeTextBox();
	$Rowsms->TextToDisplay = 'SMS';
	$Rowsms->Name = 'sms';
	$Rowsms->Mandatory = false;
	$Rowsms->AddValidator(new StringLengthValidator(128, 1));
	$f->AddRowElement($Rowsms);
	
	$r = $g->MakeComboBox();
	$r->TextToDisplay = 'Bidang';
	$r->Name = 'id_mst_balaibesar';
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
	
	$f->Action = new InsertUserHandlerMenu($p->Kode, $Status);
	$f->Action->Next = new UpdateUserMenu();
	$f->Action->Next->AddTail($p->Child());
		
	$f->Display($p, $v);
	
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>