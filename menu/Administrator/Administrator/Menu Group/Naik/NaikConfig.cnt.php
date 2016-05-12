<?php

class NaikConfigContent extends ContentInterface
{
  public function NaikConfigContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$Par = $this->Parent();
	$Conn = $Par->MakeDatabase();
	$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$CekIndex ="SELECT 
					sys_menu_group.order_index 'OrderIndex'
			   FROM 
					sys_menu_group ,sys_menu
			   WHERE 
					sys_menu.id = sys_menu_group.id__sys_menu AND 
					sys_menu_group.id__sys_menu = '".$Par->IdMenu."' AND
					sys_menu_group.id__sys_group = '".$Par->IdGroup."'			
				"; 
	$result = $Conn->Execute($CekIndex);
	$Rec = $Conn->FetchObject($result);		
	if($Rec->OrderIndex > 1){
	
	$SQL ="SELECT 
				sys_menu.id AS Id, 
				sys_menu_group.id__sys_parent AS ParentId, 
				sys_menu.description AS Keterangan,
				sys_menu_group.order_index 'OrderIndex'
		   FROM 
				sys_menu_group ,sys_menu
		   WHERE 
				sys_menu.id = sys_menu_group.id__sys_menu AND 
				sys_menu_group.id__sys_menu = '".$Par->IdMenu."' AND
			    sys_menu_group.id__sys_group = '".$Par->IdGroup."'			
			";
	$rsl = $Conn->Execute($SQL);
	$Field = $Conn->FetchObject($rsl);	
	$UpdateNaik = "
			UPDATE sys_menu_group,sys_menu SET order_index =".$Field->OrderIndex." -1
			WHERE 
				sys_menu.id = sys_menu_group.id__sys_menu AND 
				sys_menu_group.id__sys_menu = '".$Field->Id."' AND
			    sys_menu_group.id__sys_group = '".$Par->IdGroup."' AND	
				order_index ='".$Field->OrderIndex."'
	
	";
	$SQL_1 = "
		SELECT 
				sys_menu.id AS Id, 
				sys_menu_group.id__sys_parent AS ParentId, 
				sys_menu.description AS Keterangan,
				sys_menu_group.id__sys_group AS IdGroup,
				sys_menu_group.order_index AS OrderIndex
			FROM 
				sys_menu, 
				sys_menu_group 
			WHERE 
				sys_menu.id = sys_menu_group.id__sys_menu AND
				sys_menu_group.id__sys_group = '".$Par->IdGroup."' AND 				 
				sys_menu_group.order_index = ".$Field->OrderIndex." -1 AND 
				sys_menu_group.id__sys_parent = '".$Field->ParentId."'
			ORDER BY sys_menu_group.order_index, sys_menu.description ASC 

	"; 
	
	$Result = $Conn->Execute($SQL_1);
	$Field = $Conn->FetchObject($Result);
	
	$UpdateTurun = "
			UPDATE sys_menu_group,sys_menu SET order_index =".$Field->OrderIndex." + 1				
			WHERE 
				  sys_menu_group.id__sys_menu ='".$Field->Id."' AND
				  sys_menu_group.id__sys_group = '".$Field->IdGroup."' AND 
				  sys_menu_group.order_index = ".$Field->OrderIndex."  AND 
				  sys_menu_group.id__sys_parent = '".$Field->ParentId."'
	";
	
	$Conn->Execute($UpdateNaik);
	if($Conn->RowCount($Result)>0){
			$Conn->Execute($UpdateTurun);		
		}
	
	
	}
	
	
	$Conn->Execute("COMMIT;");
	$Par->Next->Process($v);  
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>