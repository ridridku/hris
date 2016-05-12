<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class LaporanDeskripsiRuasJalanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
	
	}
	public function Selected(&$aRow, MenuInterface $modified){ 
		if(
		$modified->OffSet == $aRow['IdRuasJalan _HIDE_'] &&
		$modified->OffSet == $aRow['Time _HIDE_'] &&
		$modified->OffSet == $aRow['Post _HIDE_'] &&
		$modified->OffSet == $aRow['OffSet _HIDE_'])return true;
		return false;
	}
}
?>