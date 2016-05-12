<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class EditHakAksesUser2GridContent extends ContentInterface
{
  public function EditHakAksesUser2GridContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
  	$db = $p->MakeDatabase();
  
    $Row = array();
  	$Gui = $p->MakeGuiFactory();
	$Form = $Gui->MakeForm();
	
	$Row[0] = $Gui->MakeSubTitle();
	$Row[0]->TextToDisplay = 'Update Privileges For Grid';
	
	$Row[1] = $Gui->MakeCheckBox();
	$Row[1]->Name = 'roles';
	$Row[1]->TextToDisplay = 'Column';
	
	$rsl = $db->Execute("
		SELECT `object` AS Object  
		FROM sys_menu  
		WHERE id = '". $p->IdMenu ."' 
	");
	
	$R = $db->FetchObject($rsl);
	$object_menu = unserialize($R->Object);
	$i = 0;
	foreach($object_menu->MakeContent()->FetchCollumn() as $key => $val){
		$Row[1]->Value[$i] = $key;
		$Row[1]->Output[$i] = $val;
		$i++;
	}
	
	$rsl = $db->Execute("
		SELECT field_index  
		FROM sys_data_grid_access  
		WHERE 
			id__sys_group = '". $p->IdGroup ."' AND 
			id__sys_menu_grid = '". $p->IdMenuClass ."' 
		ORDER BY field_index 	
	");
	
	$terpilih = array();
	while($R = $db->FetchObject($rsl)){
		$terpilih[] = $R->field_index;
	}
	
	$Row[1]->Checked = $terpilih;
	$Row[1]->Mandatory = false;
	$Row[1]->DoubleColumn = TRUE;
	$Row[1]->AddValidator(new CheckBoxValidator($Row[1]));

	$Row[2] = $Gui->MakeBottomButton();
	$Row[2]->OnClickMenu = clone($p->Child());
	
	$Form->Action = new EditHakAksesUser2GridHandlerMenu();
	$Form->Action->IdGroup = $p->IdGroup;
	$Form->Action->IdMenu = $p->IdMenu;
	$Form->Action->IdMenuClass = $p->IdMenuClass;
	
	$Form->Action->Next = clone($p->Child());
	
	for($a=0; $a<count($Row); $a++){
	  $Form->AddRowElement($Row[$a]);
	}
	$Form->Display($p, $v);
  }
 
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>