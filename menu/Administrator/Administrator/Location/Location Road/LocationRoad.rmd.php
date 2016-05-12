<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class LocationRoadRowModifier implements RowModifierInterface
{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();
	$aRow[RowModifierConstant::AddLink] = array();
	
	$Edit = new UpdateRoadMenu();
	$Edit->IdRoad = $aRow['IdRoad _HIDE_'];
	$m = clone($modified);
	$m->IdRoad = $aRow['IdRoad _HIDE_'];
	$Edit->AddTail($m);
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $Edit->Ref();
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';


	$Delete = new DeleteLocRoadHandlerMenu($aRow['IdRoad _HIDE_']);
	$m = clone($modified);
	$m->IdRoad = $aRow['IdRoad _HIDE_'];
	$Edit->AddTail($m);
    $Delete->Next = clone($modified);	
    
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $Delete->Ref();
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  }
  public function Selected(&$aRow, MenuInterface $modified){
  	if($modified->IdRoad == $aRow['IdRoad _HIDE_'])return true;
	return false;
  }
}
?>