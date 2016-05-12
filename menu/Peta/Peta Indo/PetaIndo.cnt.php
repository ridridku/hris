<?
/**
 * @package Content
 */
class PetaIndoContent extends ContentInterface
{
  public function PetaIndoContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$spasialPath = str_replace( '\\', '/', dirname($_SERVER["SCRIPT_FILENAME"])) . '/assets';
  
  	$db = $this->Parent()->MakeDatabase();
	$layers = array();
	$i = 0;

	$result = $db->Execute("
		SELECT * 
		FROM lyr_outer_layer 
		WHERE id NOT IN(
			SELECT DISTINCT lol.id_parent 
			FROM lyr_outer_layer lol 
			WHERE id_parent IS NOT NULL 
		)
		ORDER BY order_to_bottom 
	");
	while($rec = $db->FetchObject($result)){
		$layers[$i]->name = $rec->name;
		$layers[$i]->visibility = $rec->visibility;
		$layers[$i]->description = $rec->description;
		$layers[$i]->mapFile = $spasialPath . '/outer/' . $rec->id . '.map';
		$i++;
	}

	ContentInterface::Assign('layers', Zend_Json_Encoder::encode($layers));
  	ContentInterface::Assign('YuiRelatifPath', YUI_RELATIF_PATH);
	ContentInterface::Assign('spasialPath', $spasialPath);
	ContentInterface::Assign('urlMapServer', URL_MAP_SERVER);

	$rsl = $db->Execute("
		SELECT * 
		FROM lyr_outer_layer 
	");
	$aTab=0;
	while($record = $db->FetchObject($rsl)){
		$fname = 'assets/outer/'. $record->id .'.css';
		if(file_exists($fname)){
			$css_file[$aTab][fname] = $fname;
			$aTab++;
		}	
	}
  	ContentInterface::Assign('cssfile', $css_file);
	
	$requestChildsMenu = new RequestCandidateOuterLayerMenu();
	ContentInterface::Assign('root_requestChildsMenu', $requestChildsMenu->Ref());
	ContentInterface::Assign('root_statusSeverity', 'indo-normal');

	$m = new RequestMapServerMenu();
	ContentInterface::Assign('RequestMapServerMenu', $m->Ref());
	
	ContentInterface::Show($v);
	ContentInterface::Display();
  }
  public function Path(){return __FILE__;}
}
?>