<?php

class UpdateConfigContent extends ContentInterface
{
  public function UpdateConfigContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$Par = $this->Parent();
  	$db = $Par->MakeDatabase();	
    $Row = array();
  	$Gui = $Par->MakeGuiFactory();
	$Form = $Gui->MakeForm();	
	
	$Query = "SELECT
					id__sys_menu AS Id_Menu,
					id__sys_group AS Id_Group,
					is_active AS Is_Active
			  FROM
			  		sys_menu_group
			  WHERE
			  		id__sys_menu = '".$Par->IdMenu."' AND
					id__sys_group = '".$Par->IdGroup."' AND 
					Is_Active ='".$Par->IsActive."' 
			 ";
	$rsl =$db->Execute($Query);
	$Field = $db->FetchObject($rsl);
		
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Update Menu';
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeLabel();
    $r->Name = 'id_group';
	$r->TextToDisplay = 'Group';
	$r->FromQuery($db, "
		SELECT nama AS Value
		FROM `sys_group`
		WHERE id = '". $Par->IdGroup ."'
	");
    $Form->AddRowElement($r);	
	$r = $Gui->MakeLabel();
	$r->Name = 'id_menu_grid';
	$r->TextToDisplay = 'Menu';
	$r->FromQuery($db, "
		SELECT 
			CONCAT(sys_menu.description,'[',sys_menu.time_a_stamp,']') AS Value
		FROM 
			sys_menu,sys_menu_class
		WHERE 
			 sys_menu.id = '". $Field->Id_Menu ."' AND
			( 	sys_menu.child_id = '0' OR
				sys_menu_class.is_a_grid = '1' AND
				sys_menu.id  IN(
					SELECT id__sys_menu 
					FROM sys_menu_group 
					WHERE id__sys_group = '". GroupConstant::Administrator ."'
				)
			)
	");
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeRadio();	
	$r->Name = 'is_active';
	$r->TextToDisplay = 'Aktif';
	$r->Checked = $Field->Is_Active;
	$r->Value = array(1,0);
	$r->Output = array('Aktif','Tidak');
	$r->Mandatory = true;
	$Form->AddRowElement($r);
	
	$Form->AddRowElement($Gui->MakeBottomButton());
	
	$Form->Action = new UpdateConfigHandlerMenu($Par->IdGroup, $Par->IdMenu);
	$Form->Action->Next = clone($Par->Child());
	
	$Form->Display($Par, $v);  
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>
