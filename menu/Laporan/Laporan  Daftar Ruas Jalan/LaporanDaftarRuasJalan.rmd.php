<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class LaporanDaftarRuasJalanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$baris = 0;
		$DataDeskripsi = new LaporanDeskripsiRuasJalanMenu();
		$DataDeskripsi->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$DataDeskripsi->Time = $aRow['Time _HIDE_'];
		$tail = clone($modified);
		$tail->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$tail->Time = $aRow['Time _HIDE_'];
		$DataDeskripsi->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Lebar Ruas';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DataDeskripsi->Ref();
		
		
		$baris++;
		$DataKondisi = new LaporanKondisiRuasJalanMenu();
		$DataKondisi->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$DataKondisi->Time = $aRow['Time _HIDE_'];
		$tail = clone($modified);
		$tail->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$tail->Time = $aRow['Time _HIDE_'];
		$DataKondisi->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Kondisi Ruas';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DataKondisi->Ref();
		
		$baris++;
		$DataKondisi = new LaporanKondisiTepiJalanMenu();
		$DataKondisi->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$DataKondisi->Time = $aRow['Time _HIDE_'];
		$tail = clone($modified);
		$tail->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$tail->Time = $aRow['Time _HIDE_'];
		$DataKondisi->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Kondisi Tepi';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DataKondisi->Ref();
		
		$baris++;
		$DataKondisi = new LaporanPosisiJembatanMenu();
		$DataKondisi->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$DataKondisi->Time = $aRow['Time _HIDE_'];
		$tail = clone($modified);
		$tail->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$tail->Time = $aRow['Time _HIDE_'];
		$DataKondisi->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Jembatan';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DataKondisi->Ref();
		
				
		$baris++;
		$Hapus = new LaporanDeskripsiRuasJalanMenu();
		$Hapus->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$Hapus->Time = $aRow['Time _HIDE_'];
		$Hapus->Next = clone($modified);
				
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $Hapus->Ref();
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  
	}
	public function Selected(&$aRow, MenuInterface $modified){ 
		if(
		$modified->IdRuasJalan == $aRow['IdRuasJalan _HIDE_'] &&
		$modified->Time == $aRow['Time _HIDE_'] )return true;
		return false;
	}
}
?>