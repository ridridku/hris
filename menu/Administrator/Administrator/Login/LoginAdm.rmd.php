<?php 
require_once FW_DIR . '/constant/RowModifier.cst.php';

class LoginAdmRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$db = $modified->MakeDatabase();   
		$aRow[RowModifierConstant::AddLink] = array();

		$UpdateLogin = new EditLoginMenu();
		$UpdateLogin->NamaUser = $aRow['Nama User'];
		$tail = clone($modified);
		$tail->SelectedNama = $aRow['Nama User'];
		$UpdateLogin->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdateLogin->Ref();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';

		$DeleteUser = new DeleteLoginMenu($aRow['Nama User']);
		$DeleteUser->Next = clone($modified);
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $DeleteUser->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
	}
	public function Selected(&$aRow, MenuInterface $modified){
		return 	
			$modified->SelectedNama == $aRow['Nama User'];
	}
}
?>