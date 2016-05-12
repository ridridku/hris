<?php

class EditLoginHandlerContent extends ContentInterface
{
  public function EditLoginHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$Par = $this->Parent();
  
  	if($_POST['Password'] <> $_POST['ConfirmPassword']){
		$m = new EditLoginMenu();
		$m->NamaUser = $Par->NamaUser;
		$m->Process($v);
	}else {
  		$Conn = $Par->MakeDatabase();
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
  		$Conn->Execute("
			UPDATE sys_login SET
				user_name = '". $_POST['NamaUser'] ."',
				password = '". md5($_POST['Password']) ."', 
				id__sys_operator = '". $_POST['Nip'] ."',
				id_group = '". $_POST['IdGroup'] ."' 
			WHERE
				user_name = '". $Par->NamaUser ."' 
		");  

		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(
			array('user_name' => $_POST['NamaUser'])
		);
		$Par->Next->Process($v);
	}
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>