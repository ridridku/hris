<?php

class InsertConfigContent extends ContentInterface
{
  public function InsertConfigContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$Par = $this->Parent();
  	$db = $Par->MakeDatabase();

    $Row = array();
  	$Gui = $Par->MakeGuiFactory();
	$Form = $Gui->MakeForm();
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Insert Menu';
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeLabel();
	$r->TextToDisplay = '';
	$Form->AddRowElement($r);
	
    $r = $Gui->MakeComboBox();
    $r->Name = 'id_group';
	$r->TextToDisplay = 'Group';
	$r->OnChange = "
		  for(var i=0; i<this.childNodes.length; i++){
			 oneChild = this.childNodes[i];
			 if(oneChild.selected){
				var request = YAHOO.util.Connect.asyncRequest(
					'POST', 
					'?Menu=' + oneChild.value, 
					{
						success:function(o){
							var oResults = eval('(' + o.responseText + ')');
							var sender = YAHOO.util.Dom.get('id_menu_grid');

							if(oResults.Id == 'RequestCandidateGridUserMenu'){
								while(sender.length > 0)sender.remove(0);
								
								for(var i=0; i<oResults.nama.length; i++){
									var elm_select = document.createElement('option');
									elm_select.label = oResults.nama[i];
									elm_select.value = oResults.id[i];
									elm_select.text = oResults.nama[i]; 
									sender.add(elm_select, null);
								}
							}
						},
						failure:function(o){},
						argument:{} 
					}
				);
				
				return;
			 }
		  }";
	$rsl = $db->Execute("
		SELECT * 
		FROM `sys_group` 
		ORDER BY nama 
	");

	$i = 0;
	$selected_menu = new RequestCandidateGridUserMenu();
	$selected_menu->IdGroup = 1;
	$selected_menu->IsMandatory = true;
	$r->ItemSelected = $selected_menu->Ref();	
    while($R = $db->FetchObject($rsl)){
		$m = new RequestCandidateGridUserMenu();
		$m->IdGroup = $R->id;
		$r->Result[$i][ComboBoxConstant::Value] = $m->Ref();
		$r->Result[$i][ComboBoxConstant::Label] = $R->nama;
		$r->Result[$i][ComboBoxConstant::Output] = $R->nama;
		$i++;
    }
	$r->Mandatory = true;
	$r->AddValidator(new ComboBoxValidator($r));
    $Form->AddRowElement($r);

/*
	$r = $Gui->MakeComboBox();
    $r->Name = 'id_group';
	$r->TextToDisplay = 'Group';
	$r->OnChange = "
			  for(var i=0; i<this.childNodes.length; i++){
				 oneChild = this.childNodes[i];
				 if(oneChild.selected){
					this.AccessUrl('?Menu=' + oneChild.OnChangeMenu);
					return;
				 }
			  }";
	$rsl = $db->Execute("
		SELECT * 
		FROM `sys_group` 
		ORDER BY nama 
	");

	$i = 0;
    while($R = $db->FetchObject($rsl)){
		$m = new RequestCandidateGroupMenu();
		$m->IdGroup = $R->id;
		$r->Result[$i][ComboBoxConstant::Title] = "
			this.OnChangeMenu = '" . $m->Ref() ."';
		";
		$r->Result[$i][ComboBoxConstant::Value] = $R->id;
		$r->Result[$i][ComboBoxConstant::Label] = $R->nama;
		$r->Result[$i][ComboBoxConstant::Output] = $R->nama;
		$i++;
    }
	$r->Mandatory = true;
	$r->AddValidator(new ComboBoxValidator($r));
    $Form->AddRowElement($r);
*/
	
    $r = $Gui->MakeComboBox();
	$r->Name = 'id_menu_grid';
	$r->TextToDisplay = 'Grid';
	$r->FromQuery(new ResultInflectorWrapperDatabase($db), new QueryFilter("
		SELECT 
			sys_menu.`id_menu_class` AS id, 
			sys_menu.`object` AS Object, 
			sys_menu_class.`path` AS Path, 
			sys_menu.description AS name,
			sys_menu.time_a_stamp AS Time  
		FROM 
			sys_menu,  
			sys_menu_class 
		WHERE 
			sys_menu.id_menu_class =  sys_menu_class.id AND 
			sys_menu_class.path <> '' AND 
			sys_menu_class.is_a_grid = '1' AND 
    		sys_menu.`id_menu_class` NOT IN(
				SELECT id__sys_menu_grid 
				FROM sys_data_grid 
				WHERE id__sys_group = '". GroupConstant::Administrator ."'
			)
		ORDER BY sys_menu.description
	",
		new ColModifierResultInflector(
			$Child = new NoResultInflector(),
			new DynamicNameColModifier(
				$Child = new NoColModifier()
			)	
		)	
	));
	$r->Mandatory = true;
	$r->AddValidator(new DefaultValidator());
	$Form->AddRowElement($r);

/*	$r = $Gui->MakeComboBox();
	$r->Name = 'id_menu_grid';
	$r->TextToDisplay = 'Menu';
	$r->FromQuery(new ResultInflectorWrapperDatabase($db), new QueryFilter("
		SELECT 
			sys_menu.id AS id, 
			sys_menu.`object` AS Object, 
			sys_menu_class.`path` AS Path, 
			sys_menu.description AS name,
			sys_menu.time_a_stamp AS Time  
		FROM 
			sys_menu,  
			sys_menu_class 
		WHERE 
			sys_menu.id_menu_class =  sys_menu_class.id AND 
			(	sys_menu.child_id = '0' OR
				sys_menu.id NOT IN(
					SELECT id__sys_menu 
					FROM sys_menu_group 
					WHERE id__sys_group = '". GroupConstant::Administrator ."'
			)	)
		ORDER BY sys_menu.description 
			
	",
		new ColModifierResultInflector(
			$Child = new NoResultInflector(),
			new DynamicNameColModifier(
				$Child = new NoColModifier()
			)	
		)	
	));
	$r->Title = "
		this.HandleReceiveString[this.HandleReceiveString.length] = function(sender, txt){
			if(txt.Id == 'RequestCandidateGroupMenu'){
				while(sender.length > 0)sender.remove(0);
				if(txt.nama != null){
					for(var i=0; i<txt.nama.length; i++){
						var elm_select = document.createElement('option');
						elm_select.label = (txt.nama[i]);
						elm_select.value = txt.id[i];
						elm_select.text = (txt.nama[i]); 
						sender.add(elm_select, null);
					}
				}	
			}
			return true;
		};
	";
	$r->Mandatory = true;
	$r->AddValidator(new DefaultValidator());
	$Form->AddRowElement($r);
*/
	$r = $Gui->MakeRadio();	
	$r->Name = 'is_aktif';
	$r->TextToDisplay = 'Aktif';
	$r->Value = array(1,0);
	$r->Output = array('Aktif','Tidak');
	$r->Mandatory = true;
	$r->AddValidator(new RadioValidator($r));
	$Form->AddRowElement($r);
	
	$Form->AddRowElement($Gui->MakeBottomButton());
	
	$Form->Action = new InsertConfigHandlerMenu();
	$Form->Action->Next = clone($Par->Child());
	
	$Form->Display($Par, $v);  
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>