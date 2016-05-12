<?php

class InsertLoginHandlerContent extends ContentInterface{
  public function InsertLoginHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $Par = $this->Parent();
	$Conn = $Par->MakeDatabase();
	$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");

	$rsl = $Conn->Execute("
		SELECT *
		FROM sys_login
		WHERE 
			user_name = '".$_POST['NamaUser']."'
	");	
	if ($Conn->RowCount($rsl) == 0){
		$Conn->Execute("
				INSERT INTO `sys_login` (
					`user_name`,
					`id__sys_operator`,
					`password`,
					`id_group`
				) VALUES (
					'".$_POST['NamaUser']."',
					'".$_POST['NamaPetugas']."',
					'".md5($_POST['Password'])."',
					'".$_POST['IdGroup']."'
				)
		");	
	}	

	$Conn->Execute("COMMIT;");
	$Par->Next->OnSetKey(
		array('user_name' => $_POST['NamaUser'])
	);
	$Par->Next->Process($v);
  }  
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>