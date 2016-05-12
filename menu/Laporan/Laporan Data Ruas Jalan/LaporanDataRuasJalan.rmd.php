<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class LaporanDataRuasJalanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
	/*	
		$UpdatePelaksanaKegiatan = new UpdatePelaksanaKegiatanMenu();
		$UpdatePelaksanaKegiatan->Kode = $aRow['Kode'];
		$m = clone($modified);
		$tail = clone($modified);
		$tail->SelectedKode = $aRow['Kode'];
		$UpdatePelaksanaKegiatan->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdatePelaksanaKegiatan->Ref();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';		
		
		$DeletePelaksanaKegiatan = new DeletePelaksanaKegiatanMenu($aRow['NIP']);
		$DeletePelaksanaKegiatan->Kode = $aRow['Kode'];
		$tail = clone($modified);
		$tail->SelectedKode = $aRow['Kode'];
		$DeletePelaksanaKegiatan->AddTail($tail);
		$DeletePelaksanaKegiatan->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $DeletePelaksanaKegiatan->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  */
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