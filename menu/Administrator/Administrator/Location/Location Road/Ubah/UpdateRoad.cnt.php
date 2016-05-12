<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateRoadContent extends ContentInterface
{
  public function UpdateRoadContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $Gui = $p->MakeGuiFactory();
	$sql = "
		SELECT 	loc_road.id AS IdRoad,
				loc_road.name AS Nama,
				loc_road.id_loc_section AS LocSection,
				loc_road.id_loc_city_from AS FromCity,
				loc_road.id_loc_city_to AS ToCity,
				loc_road.id_rod_status AS Status,
				loc_road.id_rod_function AS Fungsi
 
		FROM loc_road 
		WHERE id = '".$p->IdRoad."' 
	";
	$rsl = $db->Execute($sql);
   	$Field = $db->FetchObject($rsl);

	
	$Form = $Gui->MakeForm();
	$Form->FormName = 'Data Road';
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Update Road';
	$Form->AddRowElement($r);

   	$r = $Gui->MakeTextBox();
	$r->TextToDisplay = 'Kode';
	$r->Name = 'IdRoad';
	$r->Value = $p->IdRoad ;
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = TRUE;
	$r->AddValidator(new StringLengthValidator(64, 1));
	$r->AddValidator(new CommonMasterTableValidator('loc_road', $p->IdRoad));
	$Form->AddRowElement($r);
	 
   	  		
	$r = $Gui->MakeTextBox();
	$r->TextToDisplay = 'Name';
	$r->Name = 'name';
	$r->Value = $Field->Nama ;
	$r->Size = 64;
	$r->Maxlength = 64;
    $r->Mandatory = false;
	$r->AddValidator(new StringLengthValidator(64, 1));
	$Form->AddRowElement($r);
	 	
	$r = $Gui->MakeComboBox();
	$r->TextToDisplay = 'Location section';
	$r->Name = 'id_loc_section';
	$r->ItemSelected = $Field->LocSection ;
	$r->FromQuery($db, "
		SELECT id AS id, name AS name 
		FROM loc_section"
	 );
	$r->Mandatory = false;
	$r->AddValidator(new ComboBoxValidator($r));
	$Form->AddRowElement($r);
	
	
		
	$r = $Gui->MakeComboBox();
	$r->TextToDisplay = 'From City';
	$r->Name = 'id_loc_city_from';
	$r->ItemSelected = $Field->FromCity ;
	$r->FromQuery($db, "
		SELECT id AS id, name AS name 
		FROM loc_city"
	 );
	$r->Mandatory = false;
	$r->AddValidator(new ComboBoxValidator($r));
	$Form->AddRowElement($r);
	
	
	
	$r = $Gui->MakeComboBox();
	$r->TextToDisplay = 'To City';
	$r->Name = 'id_loc_city_to';
	$r->ItemSelected = $Field->ToCity ;
	$r->FromQuery($db, "
		SELECT id AS id, name AS name 
		FROM loc_city"
	 );
	$r->Mandatory = false;
	$r->AddValidator(new ComboBoxValidator($r));
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeComboBox();
	$r->TextToDisplay = 'Status';
	$r->Name = 'id_rod_status';
	$r->ItemSelected = $Field->Status ;
	$r->FromQuery($db, "
		SELECT id AS id, name AS name 
		FROM rod_status"
	 );
	$r->Mandatory = false;
	$r->AddValidator(new ComboBoxValidator($r));
	$Form->AddRowElement($r);
	
	
	$r = $Gui->MakeComboBox();
	$r->TextToDisplay = 'Fungsi';
	$r->Name = 'id_rod_function';
	$r->ItemSelected = $Field->Fungsi ;
	$r->FromQuery($db, "
		SELECT id AS id, name AS name 
		FROM rod_function"
	 );
	$r->Mandatory = false;
	$r->AddValidator(new ComboBoxValidator($r));
	$Form->AddRowElement($r);
	
	
	$r = $Gui->MakeLabel();
	$Form->AddRowElement($r);

    $r = $Gui->MakeBottomButton();
	$r->OnClickMenu = clone($p->Child());
	$Form->AddRowElement($r);
	
	
	$Form->Action = new UpdateRoadHandlerMenu();
	$Form->Action->IdRoad = $p->IdRoad; 
	$Form->Action->Next = new UpdateRoadMenu();
	$Form->Action->Next->AddTail($p->Child());
		
	$Form->Display($p, $v);

  }
 
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>