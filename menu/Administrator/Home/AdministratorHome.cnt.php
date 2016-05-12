<?php
class AdministratorHomeContent extends ContentInterface{
	public function AdministratorHomeContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$db = $this->Parent()->MakeDatabase();
		$rsl = $db->Execute("
			SELECT 
				DISTINCT(sys_menu.id) AS Id,
				sys_menu.object AS Object, 
				sys_menu_class.image AS Image 
			FROM 
				sys_menu, 
				sys_menu_class, 
				sys_menu_group, 
				sys_login 
			WHERE 
				sys_login.user_name = '". $_SESSION[FrameworkSessionConstant::UserName] ."' AND 
				sys_menu_group.id__sys_group = sys_login.id_group AND 
				sys_menu_group.id__sys_menu = sys_menu.id AND 
				sys_menu.id_menu_class = sys_menu_class.id AND 
				sys_menu_group.is_active = '1' AND 
				sys_menu_group.id__sys_menu NOT IN(
					SELECT DISTINCT(mg.id__sys_parent) 
					FROM sys_menu_group mg 
					WHERE 
						mg.id__sys_parent IS NOT NULL AND 
						mg.id__sys_parent <> 0 AND 
						mg.id__sys_group = sys_login.id_group
				)
			LIMIT 0, 12 
		");
		
		$i = 0;
		while($R = $db->FetchObject($rsl)){
			$link = unserialize($R->Object);
			if($link->Ref() == NULL)continue;
			$datalink[$i]['link'] = $link->Ref();
			$datalink[$i]['nama'] = $link->Name();
			if($R->Image == NULL)$datalink[$i]['image'] = 'images/home/monitoring.gif';
			else $datalink[$i]['image'] = $R->Image;
			
			$i++;
		}
		if($datalink != NULL){
			ContentInterface::Assign('datalink', $datalink);
			ContentInterface::Show($v);  
			ContentInterface::Display();
		}	
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>