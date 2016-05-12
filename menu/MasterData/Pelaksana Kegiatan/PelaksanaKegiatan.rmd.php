<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class PelaksanaKegiatanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$UpdatePelaksanaKegiatan = new UpdatePelaksanaKegiatanMenu();
		$UpdatePelaksanaKegiatan->IdSatker = $aRow['ID Satuan Kerja'];
		$UpdatePelaksanaKegiatan->IdTahun = $aRow['ID Tahun Anggaran _HIDE_'];
		$m = clone($modified);
		$tail = clone($modified);
		$tail->IdSatker = $aRow['ID Satuan Kerja'];
		$tail->IdTahun = $aRow['ID Tahun Anggaran _HIDE_'];
		$UpdatePelaksanaKegiatan->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdatePelaksanaKegiatan->Ref();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';		
		
		$DeletePelaksanaKegiatan = new DeletePelaksanaKegiatanMenu($aRow['NIP']);
		$DeletePelaksanaKegiatan->IdSatker = $aRow['ID Satuan Kerja'];
		$DeletePelaksanaKegiatan->IdTahun = $aRow['ID Tahun Anggaran _HIDE_'];
		$tail = clone($modified);
		$DeletePelaksanaKegiatan->AddTail($tail);
		$DeletePelaksanaKegiatan->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $DeletePelaksanaKegiatan->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  }
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->IdSatker == $aRow['ID Satuan Kerja']&&
		$modified->IdTahun == $aRow['ID Tahun Anggaran _HIDE_'];
	}
}
?>