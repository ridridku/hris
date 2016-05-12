<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class MasterKotaRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		$UpdateMasterKota = new UpdateMasterKotaMenu();
		$UpdateMasterKota->id = $aRow['Kode'];		
		$tail = clone($modified);
		$tail->SelectedKode = $aRow['Kode'];
		$UpdateMasterKota->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdateMasterKota->Ref();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';		
		
		$DeleteMasterKota = new DeleteMasterKotaHandlerMenu();
		$DeleteMasterKota->id = $aRow['Kode'];
		$DeleteMasterKota->Next = clone($modified);
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $DeleteMasterKota->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';

  }
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->SelectedKode == $aRow['Kode'];
	}
}
?>