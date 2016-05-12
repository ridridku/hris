<?php 
require_once FW_DIR . '/constant/RowModifier.cst.php';

class ConfigGroupRowModifier implements RowModifierInterface
{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();
	
	$aRow[RowModifierConstant::AddData] = array();
	$object_menu = unserialize($aRow['Object _HIDE_']);
	if($object_menu){
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::ColName] = 'Menu';
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::ColWidth] = '400';
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::Value] = $object_menu->Name();
	}else{
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::ColName] = 'Menu';
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::ColWidth] = '400';
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::Value] = NULL;
	}
	
	$Query = "
			SELECT  
				m1.id__sys_menu 	AS Id1, 
				(SELECT description FROM sys_menu WHERE id = m1.id__sys_menu)AS Name1, 
				m2.id__sys_menu 	AS Id2, 
				(SELECT description FROM sys_menu WHERE id = m2.id__sys_menu)AS Name2, 
				m3.id__sys_menu 	AS Id3, 
				(SELECT description FROM sys_menu WHERE id = m3.id__sys_menu)AS Name3, 
				m4.id__sys_menu 	AS Id4, 
				(SELECT description FROM sys_menu WHERE id = m4.id__sys_menu)AS Name4
			FROM sys_menu_group AS m1
			LEFT JOIN sys_menu_group AS m2 ON (
					m1.id__sys_parent = m2.id__sys_menu AND 
					m1.id__sys_group = m2.id__sys_group )
				LEFT JOIN sys_menu_group AS m3 ON (
					m2.id__sys_parent = m3.id__sys_menu AND 
					m2.id__sys_group = m3.id__sys_group )
				LEFT JOIN sys_menu_group AS m4 ON(
					m3.id__sys_parent = m4.id__sys_menu AND 
					m3.id__sys_group = m4.id__sys_group )
			WHERE 
				m1.id__sys_menu = '".$aRow['IdMenu _HIDE_']."'
	";
	$rsl = $db->Execute($Query);	
	$Path = NULL;
	while($R = $db->FetchObject($rsl)){
	  	if($R->Name4 != NULL){
	  		$Path = '<label style="font-size:12px;">' . $R->Name4 . '</label>';
	 	}
	  if($R->Name3 != NULL){
			
	  		$Path .= '->' . '<label style="font-size:12px;">' . $R->Name3 . '</label>';
	  }
	  if($R->Name2 != NULL){
			
	  		$Path .= '->' . '<label style="font-size:12px;">' . $R->Name2 . '</label>';
	  }
	  if($R->Name1 != NULL){
			#$anObject = ($R->Name1);
	  		$Path .= '->' . '<label style="font-size:12px;">' . $R->Name1 . '</label>';
	  }
	}	
	
	$aRow[RowModifierConstant::AddData][1][RowModifierConstant::ColName] = 'Posisi Menu';
	$aRow[RowModifierConstant::AddData][1][RowModifierConstant::ColWidth] = '400';
	$aRow[RowModifierConstant::AddData][1][RowModifierConstant::Value] =$Path ;
		
	
	
	
	
	
    $aRow[RowModifierConstant::AddLink] = array();
	$UpdateConfig = new UpdateConfigMenu(
			$aRow['IdGroup _HIDE_'],
			$aRow['IsActive _HIDE_'],
			$aRow['IdMenu _HIDE_']
	);
	$tail = clone($modified);
	$tail->SelectedIdGroup = $aRow['IdGroup _HIDE_'];
	$tail->SelectedIdMenu = $aRow['IdMenu _HIDE_'];
	$UpdateConfig->AddTail($tail);
	
#	$UpdateConfig->AddTail(clone($modified));
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Update Configuration';
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdateConfig->Ref();
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';

    $DeleteConfig = new DeleteconfigMenu(
			$aRow['IdGroup _HIDE_'],
			$aRow['IsActive _HIDE_'],
			$aRow['IdMenu _HIDE_']
	);
	$DeleteConfig->Next = clone($modified);
    $aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete Configuration';
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $DeleteConfig->Ref();
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
	
	
	
	$NaikConfig = new NaikConfigMenu(
			$aRow['IdGroup _HIDE_'],
			$aRow['IsActive _HIDE_'],
			$aRow['IdMenu _HIDE_']
	);
	$Next = clone($modified);
	$Next->SelectedIdGroup = $aRow['IdGroup _HIDE_'];
	$Next->SelectedIdMenu = $aRow['IdMenu _HIDE_'];
	
	$NaikConfig->Next = $Next;
	$aRow[RowModifierConstant::AddLink][2][RowModifierConstant::RefName] = 'Naik';
	$aRow[RowModifierConstant::AddLink][2][RowModifierConstant::RefLink] = $NaikConfig->Ref();
	
	
	
	$TurunConfig = new TurunConfigMenu(
			$aRow['IdGroup _HIDE_'],
			$aRow['ParentId _HIDE_'],
			$aRow['IdMenu _HIDE_']
	);
	
	$Next = clone($modified);
	$Next->SelectedIdGroup = $aRow['IdGroup _HIDE_'];
	$Next->SelectedIdMenu = $aRow['IdMenu _HIDE_'];
	
	$TurunConfig->Next = $Next ; #clone($modified);
	$aRow[RowModifierConstant::AddLink][3][RowModifierConstant::RefName] = 'Turun';
	$aRow[RowModifierConstant::AddLink][3][RowModifierConstant::RefLink] = $TurunConfig->Ref();

  }
  public function Selected(&$aRow, MenuInterface $modified){return 
  		$modified->SelectedIdGroup == $aRow['IdGroup _HIDE_'] && 
		$modified->SelectedIdMenu == $aRow['IdMenu _HIDE_'];
  ;}
}
?>