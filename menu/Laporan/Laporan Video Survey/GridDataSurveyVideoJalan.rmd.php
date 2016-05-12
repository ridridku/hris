<?php 
require_once FW_DIR . '/constant/RowModifier.cst.php';

class GridDataSurveyVideoJalanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$movie = new LaporanVideoSurveyMenu();
		$movie->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$movie->Time = $aRow['Time _HIDE_'];
		$movie->Post = $aRow['Post _HIDE_'];
		$movie->OffSet = $aRow['OffSet _HIDE_'];
		$movie->IdMovie = $aRow['IdMovie _HIDE_'];
		if(!is_null($aRow['Time _HIDE_'])){
				$TimeStamp = $aRow['Time _HIDE_'];
				$TimeStampTemp = explode(' ', $TimeStamp);
				$TimeFormat1 = explode('-', $TimeStampTemp[0]);
				$TimeFormat2 = explode(':', $TimeStampTemp[1]);
				$TimeFormatResult = $TimeFormat1[0].$TimeFormat1[1].$TimeFormat1[2].$TimeFormat2[0].$TimeFormat2[1].$TimeFormat2[2];
		}
		$movie->UnixTime = $TimeFormatResult;	
		$movie->IdPropinsi = $modified->IdPropinsi;	
		$m = clone($modified);
		$m->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$m->Time = $aRow['Time _HIDE_'];
		$m->Post = $aRow['Post _HIDE_'];
		$m->OffSet = $aRow['OffSet _HIDE_'];
		$m->IdMovie = $aRow['IdMovie _HIDE_'];		
		$movie->AddTail($m);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Video';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $movie->Ref();
/*		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::NewWindow] = TRUE;*/
	}
	public function Selected(&$aRow, MenuInterface $modified){ 
		if(
		$modified->IdRuasJalan == $aRow['IdRuasJalan _HIDE_'] &&
		$modified->Time == $aRow['Time _HIDE_'] &&
		$modified->Post == $aRow['Post _HIDE_'] &&
		$modified->OffSet == $aRow['OffSet _HIDE_'] &&
		$modified->IdMovie == $aRow['IdMovie _HIDE_'])return true;
		return false;
	}
}
?>