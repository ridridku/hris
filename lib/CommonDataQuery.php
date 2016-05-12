<?php
class CommonDataQuery{
 public static function ReadTable(DatabaseInterface $db, $TableName, $KeyColumn = array(), $KeyName = array()){
		$Condition = '';
		if(is_array($KeyColumn) && is_array($KeyName)){
			if(count($KeyColumn) == count($KeyName)){
				if(count($KeyColumn) == 1){
					$Condition = $Condition . $KeyColumn[0] ." LIKE '%". $KeyName[0] ."%'";
				}
				
			}
			$Query = $db->Execute("
				SELECT
					*
				FROM
					`". $TableName ."`
				WHERE
					". $Condition ."
			");
		}
		$Field = $db->FetchArray($Query);
		return $Field;
	}
}
?>