<?php 
require_once FW_DIR . '/constant/RowModifier.cst.php';

class LibSvyRoadRowModifier implements RowModifierInterface
{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();
	$aRow[RowModifierConstant::AddLink] = array();
	
	$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'pilih';
	if(!(is_null($modified->Child()))){
		$Select = clone($modified->Child());
		$Select->IdLocRoad = $aRow['id loc road _HIDE_'];
		$Select->TimeStamp = $aRow['Waktu Survey'];
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $Select->DownToTailRef();
	}
	else{
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = NULL;
	}
  }
  public function Selected(&$aRow, MenuInterface $modified){
	return false;
  }
}
?>