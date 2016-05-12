<?php
require_once 'Zend/Json/Encoder.php';

class RequestCandidateGridUserContent extends ContentInterface{
	public function RequestCandidateGridUserContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = new ResultInflectorWrapperDatabase($p->MakeDatabase());
		$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$d->Id = get_class($p);

		$rsl = $db->Execute(new QueryFilter("
			SELECT 
				sys_menu.`id_menu_class` AS id, 
				sys_menu.`object` AS Object, 
				sys_menu_class.`path` AS Path, 
				sys_menu.description AS name,
				sys_menu.time_a_stamp AS Time  
			FROM 
				sys_menu,
				sys_menu_class  
			WHERE 
				sys_menu.id_menu_class =  sys_menu_class.id AND 
				sys_menu_class.is_a_grid = '1' AND 
				sys_menu.`id_menu_class` NOT IN(
					SELECT id__sys_menu_grid 
					FROM sys_data_grid 
					WHERE id__sys_group = '". $p->IdGroup ."'
				)
			ORDER BY sys_menu.description 
				
		",
			new ColModifierResultInflector(
				$Child = new NoResultInflector(),
				new DynamicNameColModifier(
					$Child = new NoColModifier()
				)	
			)	
		));
		while($R = $db->FetchObject($rsl)){
			$d->id[] = $R->id;
			$d->nama[] = $R->name;
		}
		echo Zend_Json_Encoder::encode($d);	
		$db->Execute("COMMIT;");
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>