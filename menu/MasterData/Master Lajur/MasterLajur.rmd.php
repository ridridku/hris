<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class MasterLajurRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$UpdateMasterLajur = new UpdateMasterLajurMenu();
		$UpdateMasterLajur->IDLajur = $aRow['ID Lajur'];
		$tail = clone($modified);
		$tail->SelectedIDLajur = $aRow['ID Lajur'];
		$UpdateMasterLajur->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdateMasterLajur->Ref();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';		
		
		$DeleteMasterLajur = new DeleteMasterLajurMenu();
		$DeleteMasterLajur->IDLajur = $aRow['ID Lajur'];
		$tail = clone($modified);
		$tail->SelectedIDLajur = $aRow['ID Lajur'];
		$DeleteMasterLajur->AddTail($tail);
		$DeleteMasterLajur->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $DeleteMasterLajur->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  	}
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->SelectedIDLajur == $aRow['ID Lajur'];
	}
}
?>