<?php 
require_once FW_DIR . '/constant/RowModifier.cst.php';

class GridDataFotoRuasJalanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$foto = new LaporanFotoRuasJalanMenu();
		$foto->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$foto->Time = $aRow['Time _HIDE_'];
		$foto->Post = $aRow['Post _HIDE_'];
		$foto->OffSet = $aRow['OffSet _HIDE_'];
		$foto->ImgId = $aRow['ImgId _HIDE_'];
		if(!is_null($aRow['Time _HIDE_'])){
			$TimeStamp = $aRow['Time _HIDE_'];
			$TimeStampTemp = explode(' ', $TimeStamp);
			$TimeFormat1 = explode('-', $TimeStampTemp[0]);
			$TimeFormat2 = explode(':', $TimeStampTemp[1]);
			$TimeFormatResult = $TimeFormat1[0].$TimeFormat1[1].$TimeFormat1[2].$TimeFormat2[0].$TimeFormat2[1].$TimeFormat2[2];
		}
		
		$foto->UnixTime = $TimeFormatResult; 
		$foto->IdPropinsi = $modified->IdPropinsi;		
		$m = clone($modified);
		$m->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$m->Time = $aRow['Time _HIDE_'];
		$m->Post = $aRow['Post _HIDE_'];
		$m->OffSet = $aRow['OffSet _HIDE_'];
		$m->ImgId = $aRow['ImgId _HIDE_'];		
		$foto->AddTail($m);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Foto';/*
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::NewPanel] = true;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ActivedMainWindow] = false;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelHeight] = 380;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelWidth] = 1200;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelTitle] = $foto->Name();*/
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $foto->Ref();
		
		
			
		

	
	}
	public function Selected(&$aRow, MenuInterface $modified){ 
		if(
		$modified->IdRuasJalan == $aRow['IdRuasJalan _HIDE_'] &&
		$modified->Time == $aRow['Time _HIDE_'] &&
		$modified->Post == $aRow['Post _HIDE_'] &&
		$modified->OffSet == $aRow['OffSet _HIDE_'] &&
		$modified->ImgId == $aRow['ImgId _HIDE_'])return true;
		return false;
	}
}
?>