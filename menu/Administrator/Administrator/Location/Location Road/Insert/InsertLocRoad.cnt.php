<?php
require_once FW_DIR . '/constant/ComboBox.cst.php';

class InsertLocRoadContent extends ContentInterface
{
  const RowCek = 0;
  
  public function InsertLocRoadContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
    $Gui = $p->MakeGuiFactory();

	$Form = $Gui->MakeForm();
	$Form->FormName = 'DataLocationRoad';
	
	$RowSub = $Gui->MakeSubTitle();
	$RowSub->TextToDisplay = 'Insert Location Road';
	$Form->AddRowElement($RowSub);

   	$r = $Gui->MakeTextBox();
	$r->TextToDisplay = 'IdRoad';
	$r->Name = 'IdRoad';
	$r->Size = 16;
	$r->Maxlength = 16;
    $r->Mandatory = TRUE;
	$r->AddValidator(new StringLengthValidator(64, 1));
	$r->AddValidator(new CommonMasterTableValidator('loc_road', NULL));
	$Form->AddRowElement($r);
	 
  	  		
	$r = $Gui->MakeTextBox();
	$r->TextToDisplay = 'Name';
	$r->Name = 'name';
	$r->Size = 64;
	$r->Maxlength = 64;
    $r->Mandatory = false;
	$r->AddValidator(new StringLengthValidator(64, 1));
	$Form->AddRowElement($r);
 	 	
	$r = $Gui->MakeComboBox();
	$r->TextToDisplay = 'Location section';
	$r->Name = 'id_loc_section';
	$r->OnChange = "
			  for(var i=0; i<this.childNodes.length; i++){
				 oneChild = this.childNodes[i];
				 if(oneChild.selected){
					this.AccessUrl('?Menu=' + oneChild.OnChangeMenu);
					return;
				 }
			  }";
	$rsl = $db->execute("
		SELECT 
			loc_section.id AS id,
			loc_section.name AS name			
		FROM loc_section
		ORDER BY loc_section.name
	");

	$i = 0;
    while($R = $db->FetchObject($rsl)){
		$m = new RequestCandidateSectionCityMenu();
		$m->IdSection = $R->id;
		$r->Result[$i][ComboBoxConstant::Title] = "
			this.OnChangeMenu = '" . $m->Ref() ."';
		";
		$r->Result[$i][ComboBoxConstant::Value] = $R->id;
		$r->Result[$i][ComboBoxConstant::Label] = $R->name;
		$r->Result[$i][ComboBoxConstant::Output] = $R->name;
		$i++;
    }
	$r->Mandatory = false;
	$r->AddValidator(new ComboBoxValidator($r));
	$Form->AddRowElement($r);	
	
		
	$r = $Gui->MakeComboBox();
	$r->TextToDisplay = 'From City';
	$r->Name = 'id_loc_city_from';
	$r->FromQuery($db, "
		SELECT loc_city.id AS id, loc_city.name AS name 
		FROM loc_city
		ORDER BY loc_city.name"
	 );
	$r->Title = "
		this.HandleReceiveString[this.HandleReceiveString.length] = function(sender, txt){
			if(txt.Id == 'RequestCandidateSectionCityMenu'){
				while(sender.length > 0)sender.remove(0);
				if(txt.nama != null){
					for(var i=0; i<txt.nama.length; i++){
						var elm_select = document.createElement('option');
						elm_select.label = (txt.nama[i]);
						elm_select.value = txt.single_id[i];
						elm_select.text = (txt.nama[i]); 
						sender.add(elm_select, null);
					}
				}	
			}
			return true;
		};
	";
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
	
	$Form->Action = new InsertLocRoadHandlerMenu($p->IdRoad);
	$Form->Action->Next = new UpdateRoadMenu();
	$Form->Action->Next->AddTail($p->Child());
		
	$Form->Display($p, $v);
	
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>