<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class MasterSatuanKerjaRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$DetailMasterSatuanKerja = new DetailMasterSatuanKerjaMenu();
		$DetailMasterSatuanKerja->Kode = $aRow['Kode'];
		$tail = clone($modified);
		$tail->SelectedKode = $aRow['Kode'];
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Detail';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::NewPanel] = true;
#		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ActivedMainWindow] = false;
#		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelHeight] = 330;
#		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelWidth] = 900;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelTitle] = $DetailMasterSatuanKerja->Name();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $DetailMasterSatuanKerja->Ref();

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
		
		$DeleteMasterSatuanKerja = new DeleteMasterSatuanKerjaMenu();
		$DeleteMasterSatuanKerja->Kode = $aRow['Kode'];
		/*$tail = clone($modified);
		$tail->SelectedKode = $aRow['Kode'];
		$DeleteMasterSatuanKerja->AddTail($tail);
		*/$DeleteMasterSatuanKerja->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][2][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][2][RowModifierConstant::RefLink] = $DeleteMasterSatuanKerja->Ref();
		$aRow[RowModifierConstant::AddLink][2][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][2][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  }
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->SelectedKode == $aRow['Kode'];
	}
}
?>