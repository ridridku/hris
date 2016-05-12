<?php 
require_once FW_DIR . '/constant/RowModifier.cst.php';

class HakAksesUser2GridRowModifier implements RowModifierInterface
{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();

    $aRow[RowModifierConstant::AddData] = array();

	$object_menu = unserialize($aRow['Object _HIDE_']);
	if($object_menu){
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::ColName] = 'Nama Menu';
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::ColWidth] = '400';
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::Value] = $object_menu->Name();
	}else{
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::ColName] = 'Nama Menu';
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::ColWidth] = '400';
		$aRow[RowModifierConstant::AddData][0][RowModifierConstant::Value] = NULL;
	}

	$rsl = $db->Execute("
			SELECT  
				m1.id__sys_menu 	AS Id1, 
				(SELECT DISTINCT(object) FROM sys_menu WHERE id = m1.id__sys_menu) AS Object1,
				NULL 	AS Name1, 
				m2.id__sys_menu 	AS Id2, 
				(SELECT DISTINCT(object) FROM sys_menu WHERE id = m2.id__sys_menu) AS Object2,
				NULL 	AS Name2, 
				m3.id__sys_menu 	AS Id3, 
				(SELECT DISTINCT(object) FROM sys_menu WHERE id = m3.id__sys_menu) AS Object3,
				NULL 	AS Name3, 
				m4.id__sys_menu 	AS Id4, 
				(SELECT DISTINCT(object) FROM sys_menu WHERE id = m4.id__sys_menu) AS Object4,
				NULL 	AS Name4 
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
				m1.id__sys_menu = '".$aRow['IdMenu _HIDE_']."' AND m1.id__sys_group = '".$aRow['IdGroup _HIDE_']."'
	");		
	$Path = NULL;
	while($R = $db->FetchObject($rsl)){
	  	if($R->Object4 != NULL){
			$anObject = unserialize($R->Object4);
	  		$Path = '<label style="font-size:12px;">' . $anObject->Name() . '</label>';
	 	}
	  if($R->Object3 != NULL){
			$anObject = unserialize($R->Object3);
	  		$Path .= '->' . '<label style="font-size:12px;">' . $anObject->Name() . '</label>';
	  }
	  if($R->Object2 != NULL){
			$anObject = unserialize($R->Object2);
	  		$Path .= '->' . '<label style="font-size:12px;">' . $anObject->Name() . '</label>';
	  }
	  if($R->Object1 != NULL){
			$anObject = unserialize($R->Object1);
	  		$Path .= '->' . $anObject->Name();
	  }
	}
	$aRow[RowModifierConstant::AddData][1][RowModifierConstant::ColName] = 'Posisi';
	$aRow[RowModifierConstant::AddData][1][RowModifierConstant::ColWidth] = '400';
	$aRow[RowModifierConstant::AddData][1][RowModifierConstant::Value] = $Path;


   
    $aRow[RowModifierConstant::AddLink] = array();
	
    $UpdateHakAksesUser2Grid = new EditHakAksesUser2GridMenu();
	$UpdateHakAksesUser2Grid->IdGroup = $aRow['IdGroup _HIDE_'];
	$UpdateHakAksesUser2Grid->IdMenu = $aRow['IdMenu _HIDE_'];
	$UpdateHakAksesUser2Grid->IdMenuClass = $aRow['IdMenuClass _HIDE_'];
	
	
	$tail = clone($modified);
	$tail->SelectedIdGroup = $aRow['IdGroup _HIDE_'];
	$tail->SelectedIdMenu = $aRow['IdMenu _HIDE_'];
	$UpdateHakAksesUser2Grid->AddTail($tail);
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Hak Akses';
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdateHakAksesUser2Grid->Ref();
  }
  public function Selected(&$aRow, MenuInterface $modified){
	return 
		$modified->SelectedIdGroup == $aRow['IdGroup _HIDE_'] && 
		$modified->SelectedIdMenu == $aRow['IdMenu _HIDE_'];
  }
}
?>