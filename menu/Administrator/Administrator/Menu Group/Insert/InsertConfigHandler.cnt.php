<?php

class InsertConfigHandlerContent extends ContentInterface
{
  public function InsertConfigHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
 
    	$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$m = $Par->MakeApplication()->GetRequest('id_group');
		$sql = "
				SELECT
						sys_menu.child_id AS IdParent
				FROM
					sys_menu,
					sys_menu_class
				WHERE
					sys_menu.id = '". $_POST['id_menu_grid'] ."'AND
					sys_menu_class.id = sys_menu.id_menu_class
				
		"; 
		$rslParent = $Conn->Execute($sql);
		$Field = $Conn->FetchObject($rslParent);	
		
		$rsl = $Conn->Execute("
			SELECT COUNT(*) AS Jumlah 
			FROM sys_menu_group 
			WHERE 
				id__sys_group = '". $m->IdGroup ."' AND
				id__sys_parent = '". $Field->IdParent ."' 
		");
		$R = $Conn->FetchObject($rsl);
		$Indeks = $R->Jumlah;
		$OrderIndeks = $Indeks + 1 ;
		
		$CekStatus = $Conn->Execute("
						SELECT * 
						FROM sys_menu_group 
						WHERE 
							id__sys_menu = '". $_POST['id_menu_grid']."' AND  
							id__sys_group = '". $m->IdGroup ."'
					");
					
		if($Conn->RowCount($CekStatus) == 0){
			if($Field->IdParent == '0'){
				$Query = "
					  INSERT INTO sys_menu_group(
						`id__sys_menu`,
						`id__sys_group`,
						`is_active` ,
						`order_index`
					  ) 
					  VALUES (
						'". $_POST['id_menu_grid'] ."',
						'". $m->IdGroup ."',
						'". $_POST['is_aktif'] ."' ,
						". $OrderIndeks ." 
					  ) 
					";
			$Conn->Execute($Query);	
			}else{
				$rsl = $Conn->Execute("
						SELECT id__sys_menu AS Id_Menu
						FROM sys_menu_group 
						WHERE 
							id__sys_group = '". $m->IdGroup ."' AND
							id__sys_menu = '". $Field->IdParent ."' 
						");
				$R = $Conn->FetchObject($rsl);
				if($R->Id_Menu != NULL){				
						$Query = "
							  INSERT INTO sys_menu_group(
								`id__sys_menu`,
								`id__sys_parent`,
								`id__sys_group`,
								`is_active` ,
								`order_index`
							  ) 
							  VALUES (
								'". $_POST['id_menu_grid'] ."',
								'". $Field->IdParent ."',
								'". $m->IdGroup ."',
								'". $_POST['is_aktif'] ."' ,
								". $OrderIndeks ." 
							  ) 
							"; 
						$Conn->Execute($Query);					
				}
			}
		}
		

		$Conn->Execute("COMMIT;");
		$Par->Next->Process($v);
  	}
  
  
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>