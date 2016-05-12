<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class GridUserRowModifier implements RowModifierInterface
{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();
	$aRow[RowModifierConstant::AddLink] = array();
	
    $Edit = new UpdateUserMenu();
    $Edit->Kode = $aRow['NIP'];
	$m = clone($modified);
	$m->Kode = $aRow['NIP'];
	$Edit->AddTail($m);
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $Edit->Ref();
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';


	$Delete = new DeleteUserMenu($aRow['NIP']);
	$m = clone($modified);
	$m->Kode = $aRow['NIP'];
	$Edit->AddTail($m);
    $Delete->Next = clone($modified);	
    
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $Delete->Ref();
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  }
  public function Selected(&$aRow, MenuInterface $modified){
  	if($modified->Kode == $aRow['NIP'])return true;
	return false;
  }
}
?>