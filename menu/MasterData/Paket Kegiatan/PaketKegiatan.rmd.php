<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class PaketKegiatanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$tail = clone($modified);
		$tail->SelectedKode = $aRow['Kode'];
		
		$UpdatePaketKegiatan = new UpdatePaketKegiatanMenu();
		$UpdatePaketKegiatan->Kode = $aRow['Kode'];
		$UpdatePaketKegiatan->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdatePaketKegiatan->Ref();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';		
		
		$DeletePaketKegiatan = new DeletePaketKegiatanMenu();
		$DeletePaketKegiatan->Kode = $aRow['Kode'];
	/*	$tail = clone($modified);
		$tail->SelectedKode = $aRow['Kode'];
		$DeletePaketKegiatan->AddTail($tail);
	*/	$DeletePaketKegiatan->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $DeletePaketKegiatan->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  }
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->SelectedKode == $aRow['Kode'];
	}
}
?>