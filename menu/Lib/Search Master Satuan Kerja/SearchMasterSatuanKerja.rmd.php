<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class SearchMasterSatuanKerjaRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		if($modified->Child() != NULL){
			$m = clone($modified->Child());
			$m->Kode = $aRow['Kode'];
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Pilih';
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $m->DownToTailRef();
		}else{
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Pilih';
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = NULL;
		}

		$UpdateMasterSatuanKerja = new UpdateMasterSatuanKerjaMenu();
		$UpdateMasterSatuanKerja->Kode = $aRow['Kode'];
		$m = clone($modified);
		$tail = clone($modified);
		$tail->SelectedKode = $aRow['Kode'];
		$UpdateMasterSatuanKerja->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $UpdateMasterSatuanKerja->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';
  }
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->SelectedKode == $aRow['Kode'];
	}
}
?>